function AllGenres()
{

  dom = document.getElementsByClassName("keyword");
  
  if (dom[0].checked)  
    for(var i = 0; i< dom.length; i++)
      dom[i].checked = true;
  else 
    for(var i = 0; i< dom.length; i++)
      dom[i].checked = false;

  UpdateFilter();
}