#!/bin/bash
while read line  
do   
   rm -rf ${0%/*}/../../$line
done < ${0%/*}/../../.gitignore

exit 0

