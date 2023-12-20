#!/bin/bash

read -p "You apdate your Alt after first install system? ^C if NOT"

PPWW=$(pwd)

RESET_PLT_COMMUNIS_TO_DEFAULT_=""
read -p "START RESET_PLT_COMMUNIS_TO_DEFAULT_ block? =================== y/n"
read RESET_PLT_COMMUNIS_TO_DEFAULT_
if [[ "${RESET_PLT_COMMUNIS_TO_DEFAULT_}" == "y" ]];then

	rm -f "$HOME"/.fonsh_path
	rm -f "$HOME"/.plt_path
	rm -f "$HOME"/.repo_path
	rm -f "$HOME"/.plt_cogos

	rm -rf "$HOME"/Bare_communis
	rm -rf "$HOME"/start
	rm -rf "$HOME"/REPOBARE

	rm -f "$HOME"/.gituid
	rm -f "$HOME"/.bios
	rm -f "$HOME"/.re_init_flash
	rm -f "$HOME"/.gitrepo
	rm -f "$HOME"/.fonsh
	rm -f "$HOME"/.plt_name

fi

SSH_REMOVE_=""
read -p "START SSH_REMOVE_ block? =================== y/n"
read SSH_REMOVE_
if [[ "${SSH_REMOVE_}" == "y" ]];then

	if [ -f "$HOME/.ssh/id_rsa" ]; then

		echo "$HOME/.ssh/ EXIST: that not first start that file"
		echo "continue with delite keys (y/n)?"
		_delit=""
		read _delit

		if [ "${_delit}" == "y" ]; then
			cp -rf ${HOME}/.ssh ${HOME}/.ssh~
		    rm -rf ${HOME}/.ssh
		fi

	fi

fi

SSH_CREATE_=""
read -p "START SSH_CREATE_ block? ========================== y/n" 
read SSH_CREATE_
if [[ "${SSH_CREATE_}" == "y" ]];then

	if ! [ -f "$HOME/.ssh/id_rsa" ]; then

		echo "continue with create keys from zip (y/n)"
		y2=""
		read y2

		if [ ${y2} == "y" ]; then
		    cp -rfv ${PPWW}/read.zip ${HOME}
		    cp -rf ${HOME}/.ssh ${HOME}/.ssh~
		    rm -rf ${HOME}/.ssh
		    cp ${PPWW}/read.zip ${HOME}/
		    unzip ${HOME}/read.zip -d ${HOME}
		    file ${HOME}/.ssh
			continue
		else
			echo "continue with create keys from ssh generate (y/n)"
			y3=""
			read y3
			[ "${y3}" == "y" ] && ! [ $y2 == "y" ]; then
		    # return 0 #! deb
		    ssh-keygen -t rsa -b 4096 -C "legioner9@inbox.ru"
		fi

		eval "$(ssh-agent -s)"
		ssh-add ~/.ssh/id_rsa
	fi
fi
# return 0 #! deb
# touch "$HOME/.plt_cogos"

#! hardcor path
PLT_COGOS_=""
read -p "START PLT_COGOS_ ? ========================== y/n" 
read PLT_COGOS_
if [[ "${PLT_COGOS_}" == "y" ]];then

	echo "$HOME"/REPOBARE/_repo/fonsh >"$HOME"/.fonsh_path
	echo "$HOME"/REPOBARE/_repo/plt >"$HOME"/.plt_path
	echo "$HOME"/REPOBARE/_repo >"$HOME"/.repo_path

	echo "altlinux" >"$HOME"/.plt_cogos

	if [ -f "$HOME/.plt_cogos" ]; then
		PLT_COGOS=$(cat "$HOME/.plt_cogos")
		if [ -n "$PLT_COGOS" ]; then
		    # echo "PLT_COGOS may be strong: fedora, altlinux"
		    if [ "$PLT_COGOS" != "fedora" ] && [ "$PLT_COGOS" != "altlinux" ];then
		        Sread -p "PLT_COGOS NOT = fedora or altlinux: Enter to exit or ^C to interrapt"
		        exit 1
		    fi

		    echo "PLT_COGOS=$PLT_COGOS"
		else
		    read -p "PLT_COGOS is empty: Enter to exit or ^C to interrapt"
		    exit 1
		fi
	else
		read -p "$HOME/.PLT_COGOS not exist: Enter to exit or ^C to interrapt"
		exit 1
	fi

	read -p "$HOME/.plt_cogos do that Enter to continue or ^C for interrapt"

	if [ $PLT_COGOS == "altlinux" ]; then

		read -p "uncomment : WHEEL_USERS ALL=(ALL) ALL: Enter to continue or ^C to interrapt exec:0)if need sudo ^C  1)su - 2)EDITOR=mcedit visudo  3). _init_flash.sh"

	fi

	if [ $PLT_COGOS == "fedora" ]; then

		echo "continue with create key in github.com (y/n)"
		github_key="n"
		read github_key

		if [ "$github_key" == 'y' ]; then

		    sudo dnf install gh -y
		    echo legioner9
		    echo 124578a124578aA
		    gh auth login
		fi

	fi

	if [ "$PLT_COGOS" == "altlinux" ]; then
		. "$PPWW"/_upd_all_alt.sh
	fi

	read -p "Press enter to continue when prepear you Alt: add ssh to github.com or ^C for interrapt"

	# legioner9
	# 124578a124578aA
	# yandex.st.ru@inbox.ru
	# qwaszx1!Aqwaszx1!A
	# gh ssh-key add ~/.ssh/id_rsa.pub

	cd ~ || read -p "$HOME/ not EXIST: ^C for interrapt"
fi

GIT_PULL_=""
read -p "START GIT_PULL_ ? ========================== y/n" 
read GIT_PULL_
if [[ "${GIT_PULL_}" == "y" ]];then

	if [ -d "$HOME"/Bare_communis ] || [ -d "$HOME"/start ]; then

		echo "$HOME/Bare_communis or $HOME/start exist continue with delit and clone (y/n)?"
		del_clone_key="n"
		read del_clone_key

		if [ "$del_clone_key" == 'y' ]; then
		    rm -rf "$HOME"/start
		    rm -rf "$HOME"/Bare_communis
		else
		    read -p "$HOME/Bare_communis or $HOME/start exist: Enter to exit or ^C to interrapt"
			exit 1 
		fi
	fi

	mkdir "$HOME"/Bare_communis
	cd "$HOME"/Bare_communis || read -p "$HOME/Bare_communis not EXIST: ^C for interrapt"
	git init --bare

	mkdir -p "$HOME"/REPOBARE/_repo

	cd "$HOME"/REPOBARE/_repo || {
		read -p "$HOME/REPOBARE/_repo not EXIST: return 1"
		return 1
	}

	git clone git@github.com:legioner9/plt.git || {
		read -p "fail: git clone git@github.com:legioner9/plt.git, return 1"
		return 1
	}

	mkdir "$HOME"/start

	cd "$HOME"/start || {
		read -p "$HOME/start/ not EXIST: return 1"
		return 1
	}
	git clone git@github.com:legioner9/communis.git || {
		read -p "fail: git clone git@github.com:legioner9/communis.git, return 1"
		return 1
	}

	git clone git@github.com:legioner9/plt.git || {
		read -p "fail: git clone git@github.com:legioner9/plt.git, return 1"
		return 1
	}

	git clone git@github.com:legioner9/fonsh.git || {
		read -p "fail: git clone git@github.com:legioner9/fonsh.git, return 1"
		return 1
	}

	mkdir "$HOME"/start
	cd communis || {
		read -p "${COMMUNIS_PATH} not EXIST, return 1"
		return 1
	}
fi
# copy before .bash

COPY_DOTFILES_=""
read -p "START COPY_DOTFILES_ ? ========================== y/n" 
read COPY_DOTFILES_
if [[ "${COPY_DOTFILES_}" == "y" ]];then

	cp -fu ${COMMUNIS_PATH}/Deploy_store/plt_bd/main_store/dot_home_files/own_plt/.bashrc "$HOME"/
	touch "$HOME"/.bashrc~
	cp -fu ${COMMUNIS_PATH}/Deploy_store/plt_bd/main_store/dot_home_files/own_plt/.bios "$HOME"/
	touch "$HOME"/.bios~
	cp -fu ${COMMUNIS_PATH}/Deploy_store/plt_bd/main_store/dot_home_files/own_plt/.re_init_flash "$HOME"/
	touch "$HOME"/.re_init_flash~
	cp -fu ${COMMUNIS_PATH}/Deploy_store/plt_bd/main_store/src_bd_communis/.gitconfig "$HOME"/
	touch "$HOME"/.gitconfig~
	cp -fu ${COMMUNIS_PATH}/Deploy_store/plt_bd/main_store/src_bd_communis/.gitrepo "$HOME"/
	touch "$HOME"/.gitrepo~
	cp -fu ${COMMUNIS_PATH}/Deploy_store/plt_bd/main_store/src_bd_communis/.gituid "$HOME"/
	touch "$HOME"/.gituid~
	cp -fu ${COMMUNIS_PATH}/Deploy_store/plt_bd/main_store/src_bd_communis/.fonsh "$HOME"/
	touch "$HOME"/.fonsh~
	echo "fed_$((1 + "$RANDOM" % 100))" >"$HOME"/.plt_name
	touch "$HOME"/.plt_name~

fi
BIOS_=""
read -p "START BIOS_ block ? ========================== y/n" 
read BIOS_
if [[ "${BIOS_}" == "y" ]];then
	#? . "$HOME"/.bios
	#? use .bachrc <- ${PLT_PATH}/.config/.env allready exist
	if . "$HOME"/.bashrc; then
		read -p "fail: . $HOME/.bashrc , return 1" 
		return 1   
	fi

	#! mm_dogit_ carp plt?
	read -p "mm_dogit_ carp plt? do it or ^C"

	if [ "$PLT_COGOS" == "fedora" ]; then
		dnf_
	fi
	if [ "$PLT_COGOS" == "altlinux" ]; then
		apt_alt_ 1
	fi

fi

BD_COMMUNIS_BCP_=""
read -p "BD_COMMUNIS_BCP_ block ? ========================== y/n" 
read BD_COMMUNIS_BCP_
if [[ "${BD_COMMUNIS_BCP_}" == "y" ]];then

	bd_communis_ -i
	bd_communis_ -b

	pull_bck_push_ -o

	mm_dogit_

fi
unset filename
