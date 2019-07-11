#1. Git patch
git  am --ignore-whitespace --ignore-space-change xxxx.patch 
git  apply --reject --ignore-whitespace --ignore-space-change "D:\pwpis\0001-Update-INFORM-for-new-reports.patch"
git  add . 
git  am  --resolved

while read changelist.txt; do
    cp -r "$image_dir" assets
done < file


git log --oneline --author="alvisl|Alvis Liu" --format=format:"%H %ai, %ci %aE %s" --since="2019-01-01" |awk '{system("git diff --name-only " $1 " "  $1"~1 ")}' |sort |uniq -d

git log --oneline --author="Louise" --format=format:"%H %ai, %ci %aE %s" --since="2019-06-05" |awk '{system("git diff --name-only " $1 " "  $1"~1 ")}' |sort |uniq -d

git log --oneline --author="Louise" --format=format:"%H %ai, %ci %aE %s" --since="2019-06-01" |awk '{system("git diff --name-only " $1 " "  $1"~1 ")}' |sort|uniq |awk '{print "\""$0"\"|\"/d/clif/pwpis/"$0"\""}' | awk -F "|" '{system("cp -v -f "$1 " " $2 )}' 

git log --oneline --grep="pdate INFORM for new reports" --format=format:"%H %ai, %ci %aE %s" --since="2019-05-05" |awk '{system("git diff --name-only " $1 " "  $1"~1 ")}' |sort |uniq|awk '{print "\""$0"\"|\"/d/clif/pwpis/"$0"\""}' | awk -F "|" '{system("cp -v -f "$1 " " $2 )}' 

 git log --oneline --format=format:"%H =>  %aE %s , %ai, %ci" --since="2019-01-01"