<script language="JavaScript">
   var now = new Date();
    var yr = now.getFullYear();
     var mName = now.getMonth() + 1;
       var dName = now.getDay() + 1;
         var dayNr = ((now.getDate()<10) ? "" : "")
              + now.getDate();
       if(dName==1) Day = "Воскресенье";
     if(dName==2) Day = "Понедельник";
   if(dName==3) Day = "Вторник";
if(dName==4) Day = "Среда";
   if(dName==5) Day = "Четверг";
     if(dName==6) Day = "Пятница";
       if(dName==7) Day = "Суббота";
    
          if(mName==1) Month="Января";
        if(mName==2) Month="Февраля";
      if(mName==3) Month="Марта";
    if(mName==4) Month="Апреля";
   if(mName==5) Month="Мая";
    if(mName==6) Month="Июня";
     if(mName==7) Month="Июля";
      if(mName==8) Month="Августа";
       if(mName==9) Month="Сентября";
        if(mName==10) Month="Октября";
         if(mName==11) Month="Ноября";
          if(mName==12) Month="Декабря";
  var todaysDate =(Day +" - "+dayNr+" "+Month+" - " + yr + "" + "");
  document.open();
  document.write(todaysDate);
</script>