#!/bin/bash
arr_res=("$(find ${REPO_PATH}/Repono -not -path "${REPO_PATH}/Repono/.git/*" -type f -size +45M)")

if [ -n "$(find ${REPO_PATH}/Repono -not -path "${REPO_PATH}/Repono/.git/*" -type f -size +45M)" ]; then
# if [ -n "$(find ${REPO_PATH}/Repono -type f -size +45M)" ]; then
    parr3e_ arr_res
    plt_info "in ${REPO_PATH}/Repono/.d/.ham/main/main.fn.lst.d/45M.sh : TRUE_EXEC : find ${REPO_PATH}/Repono -type f -size -not -path ${REPO_PATH}/Repono/.git/* +45M : return 1"
    return 1
fi

return 0