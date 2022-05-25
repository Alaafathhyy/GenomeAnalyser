let params = new URLSearchParams(location.search);
let ID=params.get('ID')
let name=params.get('name')
document.getElementById("UserID").value=ID;
    document.getElementById("UserID").innerHTML="Hello "+name+" !";
    
function validateFile(){
    if (document.getElementById("uploaded").files.length > 0) {
      document.getElementsByName("fasta_sequence")[0].disabled = true;
      document.getElementById("list").value = "file";
      alert("File Uploaded!");
    }
  
}