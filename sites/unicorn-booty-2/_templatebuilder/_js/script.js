/* ===================================
 * Template Builder v 1.2
 * =================================== */

$(document).ready(function() {
        
        var version = 1,
            variant,
            specialchar = specialchar || '~',
            loc = window.location,
            path = loc.pathname.toString().split('/'),
            apikey = '',
            elementshtml = '',
            i = 0,
            cnt = 0,
            temp = new Array();
        
        
        
        var prebuildselements = '';
        $.each(prebuilds, function(i,e){
            prebuildselements +='<li><a id="pre'+cnt+'">'+i+'</a></li>';
            cnt++;
        });
        $('#prebuild ul').html(prebuildselements);
        
        //Versions
        var versionshtml = '';
        for(j=1;j<=versions;j++){
            versionshtml += '<label> <img src="../_img/v'+j+'.png" width="40" height="40" class="variation"> <input type="radio" id="version'+j+'" name="version" value="'+j+'"></label>';
        }
        $('#versions div').html(versionshtml);
        
        
        cnt = 0;
        $.each(elements, function(i,e){cnt++;});
        
        //Elements
        var dropelements = '<ul>';
        $.each(elements, function(e,text){
            i++;
            dropelements += '<li id="e_'+e+'"><img src="../_img/types/'+e+'.gif" width="98" alt="'+e+'" title="'+text+' ('+e+')"></li>';                          
            if(!parseInt((i)%(cnt/3),10)){
                dropelements += '</ul><ul>';
            }
        });
        dropelements += '</ul>';
        $('#elements > li').html(dropelements);
        
        
        $("body").delegate("a[href^='http']", 'click', function(){
            window.open($(this).attr('href'));
            return false;
        }).ajaxError(function(event, request, settings){
            updateResult();
        });

        $("#tabs").tabs();

        $('input[name=version]').fadeTo(1,0);
        $('#footerrec, #headerrec').fadeTo(1,0.6);


        $('.variation').bind('click',function(){
            $('.variation').each(function(i,e){
                $(this).removeClass('active');
            });
            version = $(this).next().val();
            $(this).next().attr('checked','checked');
            $(this).addClass('active');
            setLocation();
        });
        
        
        $('#nav1').bind('click',function(){
            $('#tabs').tabs("select", 0);                            
        
        });
        $('#nav2').bind('click',function(){
            if(!$('#dropzone').find('img').length){
                $('#tabs').tabs("select",0);                             
                alert('Get some elements into the dropzone!');
                return false;
            }
            $('#tabs').tabs("select", 1);                            
        });
        $('#nav3').bind('click',function(){
            var version = $('input[name=version]:checked').val();
            if(!version){
                $('#tabs').tabs("select", 1);                            
                alert('please choose a color variation!');
                return false;   
            }
            saveForm();
            var type = $('input[name=type]:checked').val();
            var inline = '';
            if($('#inlinecss').is(':checked')){
                inline = '_inline';
            }
            $('#result').val('');
            $.get('../version'+version+'/all'+inline+type+'.html',function(data, e){
                $('#raw').val(data);                                                       
                updateResult();
            });
            $('#tabs').tabs("select", 2);
        });
        
        $('#cleardz').bind('click',function(){
            clearDropZone();
            updateResult();
        });
        
        
        
        $( "#dropzone" ).sortable({
            update: function(event, ui){
                updateResult();
            },
            receive: function(event, ui){
                addDeleteBtn();
            },
            connectWith: ".connect",
            helper:'original'
        }).delegate('li', 'mouseover', function(){
            $(this).find('.delete').show();
        }).delegate('li', 'mouseout', function(){
            $(this).find('.delete').hide();
        }).delegate('.delete', 'click', function(){
            $(this).parent().fadeOut(function(){
                    $(this).remove();
                    updateResult();
            });
        });
        
        
        
        
        
        $( "#elements li ul li" ).draggable({
            connectToSortable: '#dropzone',
            helper: 'clone',
            revert: 'invalid'
        });

        $('#apikey').bind('change', function(){
            apikey = $(this).val();
            if(!validKey(apikey)){
                alert('This API key seems to be invalid!');
                $('#apikey').focus().select();
                return;
            }
            if(apikey == ''){
                return;
            }
            $(this).removeAttr('class').addClass('input load');
            mcRequest('ping',{}, function(d){
                el = $('#apikey');
                el.removeClass('load');
                if(d.success){
                    el.addClass('ok');
                }else{
                    el.addClass('error');
                    alert(d.msg);
                }                                    
            });
        });
        
        
        
        
        
        $('#absoluteurls').bind('click', function(){
            setLocation();
        });
        
        $('input[name=type]').bind('change', function(){
            if($('#type_mc').is(':checked')){
                $('#mailchimpextra').slideDown();
                $('#mailchimpupload').show();
            }else{
                $('#mailchimpextra').slideUp();
                $('#mailchimpupload').hide();
            }
        }).bind('click', function(){$(this).trigger('change');});
        
        $('input[name=type]').trigger('change');
        
        $('#result').bind('focus', function(){ $(this).select();});
        
        path.pop();
        path.pop();
        
        
        
        $('#prebuild').delegate('a', 'click', function(){
            var id = $(this).text();
            clearDropZone();
            for(i=0;i<prebuilds[id].length;i++){
                $( "<li></li>" ).html( $('#e_'+prebuilds[id][i]).html() ).appendTo('#dropzone');
            }
            addDeleteBtn();
            updateResult();
        });
        
        
        $('#previewbtn').bind('click', function(){
            if(!$('#absoluteurls').is(':checked')){
                if(confirm('Sorry, but the preview only works with absolute URLs!')){
                    $('#tabs').tabs("select", 1);
                    $('#absoluteurls').focus();
                };
                return;
            }
            preview = window.open('about:blank','preview', "width=700,height=900,scrollbars=yes,location=no");
            preview.document.body.innerHTML = 'please wait...';
            setTimeout(function(){
                var data = $('#result').val();
                preview.document.body.innerHTML = data;
                
            },1500);
            
            return false;
        });
        $('#mailchimpupload').bind('click', function(){
            var name = $('#templatename').val();
            var html = $('#result').val();
            apikey = $('#apikey').val();
            if(!validKey(apikey) || apikey == ''){
                $('#tabs').tabs("select", 1);                            
                alert('This API key seems to be invalid!');
                $('#apikey').focus().select();
                return;
            }
            if(name == ''){
                $('#tabs').tabs("select", 1);                            
                alert('Please choose a name for your template!');
                $('#templatename').focus().select();
                return ;
            }
            el = $('#mc_status');
            el.removeAttr('class').addClass('load').html('');
                        
            mcRequest('templateAdd',{name:name,html:html}, function(d){
                el.removeClass('load');
                if(d.success){
                    if(d.response.error){
                        el.addClass('error').html(d.response.error);
                    }else{
                        el.addClass('ok').html('Template Uploaded! <a href="http://admin.mailchimp.com/templates/edit?id='+d.response+'">Edit it on mailchimp</a>');
                    };
                }else{
                    el.addClass('error');
                    alert(d.msg);
                }                                    
            });
            return false;
        });
        
        
        updateResult();
        restoreForm();
        
        
        function setLocation(){
            if($('#absoluteurls').is(':checked')){
                $('#domain').val(loc.protocol+'//'+loc.host+path.join('/')+'/version'+version+'/img/');
            }else{
                $('#domain').val('');
            }
        }
        
        function mcRequest(method, data, callback){
            $.post("proxy.php", {
                   apikey : apikey,
                   method : method,
                   data: data
                   },
              function(data){
                  callback(data);
            }, "json");

        }
        
        function validKey(key){
            return (/^[0-9a-f]{32}-[0-9a-z]{3}$/.test(key) || !key);
        }
        
        function addDeleteBtn(){
            $('a.delete', '#dropzone').remove();
            $('#dropzone li').each(function(i,e){
                $(this).removeAttr('id');
                $(this).prepend('<a class="delete" title="delete this item">X</a>');
            });
        }
        
        function saveForm(){
            
            $('#apikey').attr('disabled','disabled');
            
            if($('#savesettings').is(':checked')){
                data = $('#form').serialize();
                setCookie('formdata',data);
            }else{
                data = null;
                setCookie('formdata',data,-100);
            }
            
            $('#apikey').remove('disabled');
        }
        
        function restoreForm(){
            data = getCookie('formdata');
            if(data){
                data = unserialize(data);
                $.each(data, function(e,v){
                    el = $('#'+e);
                    switch(el.attr('type')){
                        case 'checkbox':
                            el.attr('checked','checked');
                            break;
                        case 'text':
                        default:
                            if($('input[name='+e+']:radio').length){
                                el = $('input[name='+e+']');
                                el.removeAttr('checked');
                                el = $('input[value='+v+']');
                                el.attr('checked','checked').trigger('change');
                                if(e == 'version'){el.prev().trigger('click');}
                            }else{
                                v = decodeURIComponent(unescape(v));
                                el.val(v.replace(/\+/g,' '));
                            }
                            break;
                    }
                });
            }else{
                $('#header_footer, #absoluteurls, #savesettings, #type_normal').attr('checked','checked');  
            }
        }
        
        function unserialize(d,a){
            var d=d.split("&");
            if(a){ 
                var s=new Array();
            }else{
                var s=new Object();
            }
            $.each(d, function(){
                var p=this.split("=");
                    s[p[0]]=(p[1]);
            });
            return s;
        }
        function updateResult(){
            var str = '';
            var ar = '';
            $('#dropzone').find('img').each(function(i,e){
                ar += ", '"+$(e).attr('alt')+"'";                     
                str += getPart($(e).attr('alt'));                     
            });
            if($('#header_footer').is(':checked') && str){
                str = getHeader()+str+getFooter();
            }
            
            if($('#absoluteurls').is(':checked')){
                domain = $('#domain').val();
                str = str.replace(/src="img\//g,'src="'+domain);
                str = str.replace(/background="img\//g,'background="'+domain);
                str = str.replace(/url\('img\//g,"url('"+domain);
            }
            
            str = str || "Oops, something is wrong here...\n\nOne of this problems occurs:\n1.You are watching the preview on Themeforest\n2.You didn't upload the template files correctly\n\n";
            if(!ar){
                $('#dropzone').addClass('bg');  
            }else{
                $('#dropzone').removeClass('bg');   
            }
            
            //console.log(ar);
            
            $('#result').val(str);
        }
        
        function getPart(id){
        
            var regex = '(<!-- [^'+specialchar+']+)'+specialchar+''+id+''+specialchar+' -->([^'+specialchar+']+)'+specialchar+''+id+''+specialchar+'([^<]+)';
            
            c = new RegExp(regex,'g');
            data = c.exec($('#raw').val());
            if(data){
                return data[1]+' -->'+data[2]+' '+data[3];
            }else{
                return '';  
            }
        }
        function getHeader(){
            c = new RegExp('([^'+specialchar+']+)([^>]+)','gi');
            data = c.exec($('#raw').val());
            if(data){
                return data[1]+data[2].substr(1)+'>'+"\n";
            }else{
                return '';  
            }
        }
        function getFooter(){
            c = new RegExp('<!-- Footer start -->([^'+specialchar+']+)','gi');
            data = c.exec($('#raw').val());
            if(data){
                return '<!-- Footer start -->'+data[1];
            }else{
                return '';  
            }
        }
        function clearDropZone(){
            $('#dropzone').html('');
        }
        function setCookie(k, v, e) {
            var a = new Date(),
                e = e || 1000*60*60*24*365;
                a = new Date(a.getTime() + e);
                document.cookie = k+'='+v+'; expires='+a.toGMTString()+'; ';  
        }
        function getCookie(k) {
            var a = document.cookie.split(';');
            var c = new Array();
            for(i=0;i<a.length;i++){
                v=a[i].substring(a[i].search('=')+1);
                if(k == jQuery.trim(a[i].substring(0,a[i].search('=')))){
                    return v; 
                }
            }
            return false;
        }
});

