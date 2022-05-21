while read line  
do   
   rm -R ${0%/*}/../$line
done < ${0%/*}/../.gitignore
