function submit_form(name, id, form) {
  if (name != 'Show All Documents' && name != 'Show all provinces'
      && name != 'Sort By Document')
    document.getElementById(id).value = name;
  else
    document.getElementById(id).value = "";
  form.submit();
}
