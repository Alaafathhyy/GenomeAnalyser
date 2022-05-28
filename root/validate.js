function getFile(filePath) {
  return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
}



function valid() {

  let file = document.getElementById("uploaded");
  if (document.getElementById("GSeq").value == "" && file.value == "") {
    alert("please enter the sequence or upload")
    event.preventDefault();
    return ;

  }
  var filePath = file.value;
  var allowedExtensions = /(\.fasta)$/i;
 // alert(filePath);
  if( file.value !=""&&!allowedExtensions.exec(filePath)) {
    alert("only fasta sequence are allow ")
    file.value = '';
    event.preventDefault();
    return ;

  }

 
}
