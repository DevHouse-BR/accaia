
function doPreview(){
     temp = conteudo_coluna2.innerHTML;
     preWindow= open('', 'previewWindow', 'width=700,height=440,status=yes,scrollbars=yes,resizable=no,toolbar=no,menubar=no');
     preWindow.document.open();
     preWindow.document.write(temp);
     preWindow.document.close();
}


