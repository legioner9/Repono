<?php
/*
=====================================================
 Файл: navigation.class.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: класс для навигации
=====================================================
*/

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//------------------------------------------=-=-=-=-=
//	Класс для навигации
//------------------------------------------=-=-=-=-=

class OffersNavigation {
	
	var $URL = "";
	var $Page = "";
	var $Total = "";
	var $Ajax = false;
	var $AjaxURL = "";
	var $Tpl = "";
	var $Compile = "content";
	
	// Отдаёт сгенерированную ссылку или Url по необходимости
	function CNPage( $page, $title = "", $return = "" ){
		$link = str_replace( "{page}", $page, $this->URL );
		if( $return == "url" ) return $link;
		if( $this->Ajax ) $OnClick = str_replace( "{page}", $page, $this->AjaxURL );
		if( $title ) $page = $title;
		return "<a {$OnClick} href=\"{$link}\">{$page}</a> ";
	}
	
	// Генерирует лист ссылок
	function LPage( $start, $end ){
	 
		while( $start < $end )
			{ 
				if( $start == $this->Page )
					$navigation .= "<span>".$start."</span>\n";
				else
					$navigation .= $this->CNPage( $start );				
				$start++;
			} 
			
		return $navigation;
	}
	
	// Формирование навигации происходит в этой функции
	function BuildNavigation(){
		global $tpl;
		
		// Если ноль страниц, то навигацию не формируем
		if( $this->Total < 2 ) return;
		
		// Отчищаем старую сгенерированную навигацию
		//$tpl->result[ $this->Compile ] = "";
		
		// Чтобы не было недоразумений
		if( $this->Page < 1 ) $this->Page = 1;
		if( $this->Page > $this->Total ) $this->Page = $this->Total;
	
		$first = $this->Page - 4; // Сколько страниц выводится слева от активной
		$last = $this->Page + 5; // Сколько страниц выводится справа от активной
		$PPage = $this->CNPage( $this->Page - 1 , "", "url" ); // Предыдущая страница
		$NPage = $this->CNPage( $this->Page + 1 , "", "url" ); // Следующая страница
		$PageMin = 8; // Минимально значение для начала пагинации
		$PageMax = $this->Total - 8; // Максимально значение для начала пагинации
		$divider = "... ";  // На что заменяем пробелы
		
		// Проверка Ajax
		if( $this->Ajax ) 
			{
				$OnClickPrev = str_replace( "{page}", ( $this->Page - 1 ), $this->AjaxURL );
				$OnClickNext = str_replace( "{page}", ( $this->Page + 1 ), $this->AjaxURL );
			}
		  
		 // Подгрузка шаблона
		$tpl->load_template( $this->Tpl );
	
		// Предыдущая страница
		if( $this->Page > 1 )
			$tpl->set_block( "'\[prev-link\](.*?)\[/prev-link\]'si", "<a {$OnClickPrev} href=\"{$PPage}\">\\1</a>" );
		else
			$tpl->set_block( "'\[prev-link\](.*?)\[/prev-link\]'si", "<span>\\1</span>" );
		  
		// Слудеющая страница
		if( $this->Page < $this->Total )
			$tpl->set_block( "'\[next-link\](.*?)\[/next-link\]'si", "<a {$OnClickNext} href=\"{$NPage}\">\\1</a>" );
		else
			$tpl->set_block( "'\[next-link\](.*?)\[/next-link\]'si", "<span>\\1</span>" );
	
		// Если страниц меньше чем 10
		if( $this->Total < 10 )
			{
				$navigation = $this->LPage( 1, $this->Total + 1 );
				$navigation = $navigation;
			}
				else
			{	  
				// По середине  
				if( ( $this->Page >= $PageMin - 2 ) and ( $this->Page <= $PageMax + 2 ) )
					{
						$navigation = $this->LPage( $first, $last );
						$navigation = $this->CNPage( "1" ).$divider.$navigation.$divider.$this->CNPage( $this->Total );
					}
				// Если страница не больше 8 - ой
				elseif( $this->Page < $PageMin )
					{  
						$navigation = $this->LPage( 1, $PageMin + 1 );
						$navigation = $navigation.$divider.$this->CNPage( $this->Total );
					}
				// Если страница больше пред 8 - ми последней
				elseif( $this->Page > $PageMax )
					{
						$navigation = $this->LPage( $PageMax, $this->Total + 1 );
						$navigation = $this->CNPage( "1" ).$divider.$navigation;
					} 
			}	
	  	
		// Назначение тегов для шаблона
		$tpl->set( "{navigation}", $navigation );
		$tpl->set( "{page}", $this->Page );
		$tpl->set( "{count_page}", $this->Total );
		
		if( $this->Total < 2 )
			{
				$tpl->set_block( "'\[page\](.*?)\[/page\]'si", "" );
			}
				else
			{
				$tpl->set( "[page]", "" );
				$tpl->set( "[/page]", "" );
			}
		
		// Формирование шаблона
		$tpl->compile( $this->Compile );
		
		// Очистка класса шаблонов от навигации
		$tpl->clear();
		
		// Очистка навигации
		unset( $navigation );
	}
}

?>