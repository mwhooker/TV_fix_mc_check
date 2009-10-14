#!/bin/bash
echo "want to be as close to 0 as possible:" 1>&2

DENOMINATOR=$(diff test/*formatted.php | grep "\-\-\-" | wc -l)

phc --no-leading-tab --tab='    ' --run fix_mcd_lookup.la test/before_formatted.php --pretty-print > 0
echo "scale=2; ($(diff 0 test/after_formatted.php | grep '\-\-\-' | wc -l)/$DENOMINATOR)*100" | bc
