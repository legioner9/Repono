#!/bin/bash
arr_res=()

IFS=$'\n'
arr_res=($(find ${REPO_PATH}/Repono -not -path "${REPO_PATH}/Repono/.git/*" -type f -size +${1}M))
IFS=$' \t\n'

# IFS=$'\n'
if [ -n "${arr_res[0]}" ]; then
# if [ -n "$(find ${REPO_PATH}/Repono -type f -size +${1}M)" ]; then
    parr3e_ arr_res
    plt_info "in ${REPO_PATH}/Repono/.d/.ham/main/main.fn.lst.d/${1}M.sh : TRUE_EXEC : find ${REPO_PATH}/Repono -type f -size -not -path ${REPO_PATH}/Repono/.git/* +45M : return 1"
    return 1
fi
# IFS=$' \t\n'

return 0