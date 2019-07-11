while read changelist.txt; do
    cp -r "$image_dir" assets
done < file

awk '{print "\""$1"\"|\"/d/git/pwpis/"$1"\""}' changelist.txt | awk -F "|" '{system("cp -v -f "$1 " " $2 )}' 

awk '{print "\""$0"\"|\"/d/git/pwpis/"$0"\""}' changelist.txt | awk -F "|" '{print $2 }' 

awk '{print "\""$0"\"|\"/d/git/pwpis/"$0"\""}' changelist.txt | awk -F "|" '{system("cp -v -f "$1 " " $2 )}' 

git log --oneline --grep="pdate INFORM for new reports"  --format=format:"%H %ai, %ci %aE %s" --since="2019-01-01"  >> louise.txt
git log --oneline --author="alvisl|Alvis Liu" --format=format:"%H %ai, %ci %aE %s" --since="2019-01-01"  >> louise.txt
awk '{print "git diff --name-only " $1 " "  $1"~1 >> changelist.txt"}' louise.txt  > change.sh
git log --oneline --author="Louise" --format=format:"%H %ai, %ci %aE %s" --since="2018-10-12" > louise.txt


git log --oneline --author="Louise" --format=format:"%H %ai, %ci %aE %s" --since="2019-06-05" 


git log --oneline --author="Louise" --format=format:"%H %ai, %ci %aE %s" --since="2019-06-05" |awk '{system("git diff --name-only " $1 " "  $1"~1 ")}' |sort |uniq -d
git log --oneline --author="alvisl|Alvis Liu" --format=format:"%H %ai, %ci %aE %s" --since="2019-01-01" |awk '{system("git diff --name-only " $1 " "  $1"~1 ")}' |sort |uniq -d


git log --oneline --author="alvisl|Alvis Liu" --format=format:"%H %ai, %ci %aE %s" --since="2019-01-01" |awk '{system("git diff --name-only " $1 " "  $1"~1 ")}' |sort |uniq -d|awk '{print "\""$1"\"|\"/d/clif/pwpis/"$1"\""}' | awk -F "|" '{system("cp -v -f "$1 " " $2 )}' 


git log --oneline --author="Louise" --format=format:"%H %ai, %ci %aE %s" --since="2019-06-05" |awk '{system("git diff --name-only " $1 " "  $1"~1 ")}' |sort |uniq -d

git log --oneline --author="Louise" --format=format:"%H %ai, %ci %aE %s" --since="2019-06-01" |awk '{system("git diff --name-only " $1 " "  $1"~1 ")}' |sort|uniq |awk '{print "\""$0"\"|\"/d/clif/pwpis/"$0"\""}' | awk -F "|" '{system("cp -v -f "$1 " " $2 )}' 

git log --oneline --grep="pdate INFORM for new reports" --format=format:"%H %ai, %ci %aE %s" --since="2019-05-05" |awk '{system("git diff --name-only " $1 " "  $1"~1 ")}' |sort |uniq|awk '{print "\""$0"\"|\"/d/clif/pwpis/"$0"\""}' | awk -F "|" '{system("cp -v -f "$1 " " $2 )}' 
 


 git log --oneline --format=format:"%H =>  %aE %s , %ai, %ci" --since="2019-01-01"