#!/bin/bash

BLACK="\033[0;30m"
RED="\033[0;31m"
GREEN="\033[0;32m"
YELLOW="\033[0;33m"
BLUE="\033[0;34m"
PURPLE="\033[0;35m"
CYAN="\033[0;36m"
WHITE="\033[0;37m"
RESET="\033[0m"
NUKE="${RED}☢${RESET}"
SKULL="${WHITE}☠${RESET}"

# automatic git-nuke use this...
if ! [ "$SKIP_TIMER" == '1' ]
then
    echo -e "git $NUKE - press ctrl + c to abort"
    for i in {3..1}
    do
        echo "   $i"
        sleep 1
    done
fi


function skull {
cat << EOF

                 uuuuuuu
             uu###########uu
          uu#################uu
         u#####################u
        u#######################u
       u#########################u
       u#########################u
       u######"   "###"   "######u
       "####"      u#u       ####"
        ###u       u#u       u###
        ###u      u###u      u###
         "####uu###   ###uu####"
          "#######"   "#######"
            u#######u#######u
             u#"#"#"#"#"#"#u
  uuu        ##u# # # # #u##       uuu
 u####        #####u#u#u###       u####
  #####uu      "#########"     uu######
u###########uu    """""    uuuu##########
####"""##########uuu   uu#########"""###"
 """      ""###########uu ""#"""
           uuuu ""##########uuu
  u###uuu#########uu ""###########uuu###
  ##########""""           ""###########"
   "#####"                      ""####""
     ###"                         ####"

EOF
}


git reset HEAD > /dev/null 2>&1
git clean -dfx > /dev/null 2>&1
git checkout . > /dev/null 2>&1
skull
echo -e "$SKULL all your local changes are gone $SKULL"
