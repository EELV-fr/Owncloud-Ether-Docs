$.fn.filterExtension = function(extension) {
  return this.filter(function() { 
    var filename = $(this).attr('data-file');
    if(filename.lastIndexOf('.')){
      return filename.substr(filename.lastIndexOf('.')+1) === extension; 
    }
  });
};

function FileToPad(dir,file){
  pad=this;
  pad.dir=dir;
  pad.file=file;
  pad.url='about:blank';
  $.get(
    OC.filePath('files','ajax','download.php?dir='+dir+'&files='+file),
    function name(link) {
      pad.url=link.split('\n')[1].substr(4);
      pad.show();
    }
  );
}

FileToPad.prototype={  
  show:function(){
    $("#editor").hide();
    $('#content table').hide();
    $('#controls').hide();
    var oldcontent = $('#content').html();
    $('#content').html(oldcontent+'<div id="filetopad_bar">Titel: <strong>'+pad.file.replace('.pad','')+'</strong>, Öffentlicher Link: <a href="'+pad.url+'">'+pad.url+'</a>'+'<a id="filetopad_close">x</a></div><iframe style="width:100%;height:90%;display:block;" id="filetopad_frame" src="'+pad.url+'"></iframe>');
    $('#pageWidthOption').attr('selected','selected');    
    $('#filetopad_bar').css('padding-left','30px');  
    
    $('#filetopad_close').click(function(){pad.hide();});
    $('#filetopad_close').css('float','right');
    $('#filetopad_close').css('padding','5px');
  },
  hide:function(){
    $('#content table').show();
    $('#controls').show();
    $('#editor').show();
    $('iframe').remove();
      $('a.action').remove();
      $('#filetopad_bar').remove();
  }
};

$(document).ready(function(){
  if(location.href.indexOf('files')!=-1) {
    $('tr').filterAttr('data-type', 'file').filterExtension( 'pad').attr('data-mime','text/x-url');
    $('tr').filterAttr('data-type', 'file').filterExtension( 'pad').children('td:first-child').css('background-image','url('+OC.imagePath('files_etherpad', 'pad.png')+')');
    if (typeof FileActions!=='undefined'){
      FileActions.register('text/x-url',t('files_etherpad','Edit'), OC.PERMISSION_READ, '',function(filename){
        pad=new FileToPad($('#dir').val(),filename);
      });
     FileActions.setDefault('text/x-url',t('files_etherpad','Edit'));
    }
  }
  if($('div#new>ul>li').length > 0) {
    getMimeIcon('text/plain', function(icon) {
      $('<li><p>' + t('files_etherpad', 'Pad') + '</p></li>')
        .attr('id', 'newPadFile')
        .appendTo('div#new>ul')
        .css('background-image', 'url(' + OC.imagePath('files_etherpad', 'pad.png') + ')')
        .data('type', 'text')
        .children('p')
        .click(function() {
          $(this).hide();
          var form=$('<form></form>');
          var input=$('<input>');
          form.append(input);
          form.appendTo('#newPadFile');
          input.focus();
          form.submit(function(event){
            event.stopPropagation();
            event.preventDefault();
            $.get(
              OC.filePath('files_etherpad', 'ajax', 'host.php'),
              function (url) {
                var filename=input.val();
                var content='[EtherpadShortcut]\nURL='+url+'/p/'+CryptoJS.MD5('owncloud' + new Date().getMilliseconds() + 'etherpad');
                $.post(
                  OC.filePath('files','ajax','newfile.php'),
                  {dir:$('#dir').val(),filename:filename+'.pad',content:content},
                  function(result){
                    if (result.status == 'success') {
                      var date=new Date();
                      FileList.addFile(filename+'.pad',0,date,false,false);
                      var tr=$('tr').filterAttr('data-file',filename+'.pad');
                      tr.attr('data-mime','text/x-url');
                      tr.attr('data-id', result.data.id);
                      var path = $('#dir').val();
                      getMimeIcon('text/plain',function(path){
                        tr.find('td.filename').attr('style','background-image:url('+OC.imagePath('files_etherpad', 'pad.png')+')');
                      });
                    } else {
                      OC.dialogs.alert(result.data.message, 'Error');
                    }
                  }
                );
              }
            );
          });
        });
    });
  }
});
