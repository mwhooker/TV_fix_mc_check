#include <AST.h>
#include "AST_visitor.h"
#include <pass_manager/Plugin_pass.h>
#include "lib/demangle.h"
#include "process_ir/General.h"
using namespace std;
using namespace AST;


class MCCheck : public Visitor {
    Variable *v;
    bool from_if;
public:
    MCCheck() : from_if(false) {};
    void post_assignment(Assignment* in) {
        /*
        if (isa<Method_invocation>(in->expr) && 
               dynamic_cast<Method_invocation*>(in->expr)->match(
                  new METHOD_NAME(new String("get_cache")))) {
           cout << "Got one!" << endl;  
        }*/
        if (isa<Method_invocation>(in->expr) 
                && dynamic_cast<Method_invocation*>(in->expr)
                ->method_name->match(new METHOD_NAME(new String("get_cache")))) 
        {
            v = in->variable;
            cout << "true" << endl; 
        }
        //METHOD_NAME* name =dynamic_cast<METHOD_NAME*>(in->method_name);
        //cout << name->value <<endl;
    }
    
    void pre_unary_op(Unary_op* in) {
        if (in->op->match(new OP(new String("!")))) {
            cout << "got unary op " << in->op->value->c_str();
            if (isa<Variable>(in->expr) && from_if && in->expr->match(v)) {
                in->expr = new Method_invocation(
                            NULL,
                            new METHOD_NAME(new String("$this->last_memcache_lookup_succeeded")),
                            new List<Actual_parameter*>()
                        );

                cout << " yes";
            }
            cout << endl;
        }
    }

    
    void pre_if(If* in) {
        from_if = true;
    }
    
    void post_if(If* in) {
        from_if = false;
        v = 0;
    }

};

extern "C" void load (Pass_manager* pm, Plugin_pass* pass)
{
    pm->add_after_named_pass (pass, new String ("ast"));
}

extern "C" void run_ast (AST::PHP_script* in, Pass_manager* pm, String* option)
{
    MCCheck mcc;
    in->visit(&mcc);
}

