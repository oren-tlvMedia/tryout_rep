#calculate the time diff


START=$(date +%s.%N)
command
END=$(date +%s.%N)
DIFF=$(echo "$END - $START" | bc)
echo $DIFF
