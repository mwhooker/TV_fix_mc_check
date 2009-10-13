#!/bin/bash
echo "want to be as close to 0 as possible:" 1>&2

phc --no-leading-tab --tab='    ' --run fix_mcd_lookup.la test/before.php --pretty-print > 0
echo "scale=2; ($(diff 0 test/after_formatted.php | grep '\-\-\-' | wc -l)/8)*100" | bc
