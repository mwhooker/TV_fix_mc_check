#include <AST.h>
#include "AST_transform.h"
#include <pass_manager/Plugin_pass.h>
#include "lib/demangle.h"
#include "process_ir/General.h"
using namespace std;
using namespace AST;


/**
 * @todo check for other ways one might check for falseness
 */
class MCCheck : public Transform {
    Variable *v;
    bool from_if, valid_class;
    Method_invocation *replace_with;

public:
    MCCheck() : v(NULL), from_if(false), valid_class(false) {
        replace_with = new Method_invocation(
                NULL,
                new METHOD_NAME(new String("$this->last_memcache_lookup_succeeded")),
                new List<Actual_parameter*>()
                );

    };


    void pre_class_def(Class_def* in, Statement_list* out) {
        if (in->extends->match(new CLASS_NAME(new String("GNE")))
                || in->extends->match(new CLASS_NAME(new String("TV")))
                || in->extends->match(new CLASS_NAME(new String("Data")))) {

           valid_class = true; 
        }
        out->push_back(in);
    }

    void post_class_def(Class_def* in, Statement_list* out) {
        valid_class = false;
        out->push_back(in);
    }

    Expr* post_assignment(Assignment* in) {
        if (isa<Method_invocation>(in->expr) 
                && dynamic_cast<Method_invocation*>(in->expr)
                ->method_name->match(new METHOD_NAME(new String("get_cache")))) {

            v = in->variable;
        }
        return in;
    }

    void pre_if(If* in, Statement_list* out) {
        from_if = true;
        out->push_back(in);
    }

    void post_if(If* in, Statement_list* out) {
        from_if = false;
        v = NULL;
        out->push_back(in);
    }

    Expr *pre_unary_op(Unary_op* in) {
        if (in->op->match(new OP(new String("!")))
                && in->expr->match(v)
                && from_if
                && valid_class) {

            in->expr = replace_with->clone();
        }
        return in;
    }
    
    //if in an if statement and one of the operators is v, replace with method call expr
    Expr *pre_bin_op(Bin_op *in) {
        if ((in->op->match(new OP(new String("!=")))
                    || in->op->match(new OP(new String("=="))))
                && from_if
                && valid_class) {

            if (in->left->match(v)) {
                in->left = replace_with->clone(); 
            }
            if (in->right->match(v)) {
                in->right = replace_with->clone(); 
            }
        }
        return in;
    }
    

};

extern "C" void load (Pass_manager* pm, Plugin_pass* pass)
{
    pm->add_after_named_pass (pass, new String ("ast"));
}

extern "C" void run_ast (AST::PHP_script* in, Pass_manager* pm, String* option)
{
    MCCheck mcc;
    in->transform_children(&mcc);
}

