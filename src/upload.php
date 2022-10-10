<?php

$html_header = <<<EOLONGTEXT
<!--

    =======================================
    ====
    ====  This is the project uploads-yapfu
    ====
    ====  Yet Another Php File Uploader (all-in-one-php-file)
    ====
    =======================================
    ====
    ====  2022-07-12
    ====
    ====  v 0.915
    ====
    ====
    ====
    ====
    ==== (c) 2022 JF Lemay (FR) (contact via github Jeff42820)
    ====
        MIT License

        Copyright (c) 2022 JF Lemay

        Permission is hereby granted, free of charge, to any person obtaining a copy
        of this software and associated documentation files (the "Software"), to deal
        in the Software without restriction, including without limitation the rights
        to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
        copies of the Software, and to permit persons to whom the Software is
        furnished to do so, subject to the following conditions:

        The above copyright notice and this permission notice shall be included in all
        copies or substantial portions of the Software.

        THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
        IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
        FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
        AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
        LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
        OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
        SOFTWARE.
    ====
    ====
    =======================================

-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="icon" type="image/svg+xml" href="favicon.svg" />
<title>Yapfu File Uploader</title>
EOLONGTEXT;     // $html_header



$allowed_ext = [ 'jpeg','jpg','png', 'gif', 'svg', 'psd', 'bmp', 
    'zip', 'gz',  'tgz', 'pdf', 'txt', 'rtf', 'epub', 'csv',
    'ofc', 'qif', 'ofx',
    'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pps', 'ppsx',
    'odt', 'ods', 'odp', 'odg', 
    'mp3', 'mp4', 'm4a', 'm4v', 'avi', 'mkv', 'mov', 'wmv' ];

$current_directory = getcwd();
$msg_from_php='';
$user='';
$upl_maxsize=2;     // 2Mb by default
$session_hash='';
$locale='en_US.UTF-8';
$clientip  = getClientIpAddr();

/* ==========================================
   = svg
              svg images

   ========================================== */

/* Logo svg file, message
    Set name: Simple Files
    Author: Anastasya Bolshakova
    Website: https://www.iconfinder.com/nastu_bol
    Published: 9 Jun, 2018
    License: Creative Commons (Attribution 3.0 Unported) */

$svg_file = <<<EOLONGTEXT
<?xml version="1.0" encoding="UTF-8"?>
<svg width="128px" height="128px" enable-background="new 0 0 128 128" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path d="m73.697 1h-33.03c-6.669-4e-3 -12.771 2.723-17.134 7.097-4.374 4.362-7.101 10.465-7.097 17.134v77.54c-4e-3 6.669 2.723 12.771 7.097 17.132 4.363 4.375 10.465 7.101 17.134 7.098h46.667c14.214-1.0658 24.037-11.331 24.231-24.23v-63.906zm13.949 33.748c-2.688-0.101-5.063-1.199-6.852-2.978-1.776-1.789-2.877-4.164-2.977-6.851zm6.922 75.256c-1.874 1.862-4.387 2.992-7.234 2.996h-46.667c-2.847-4e-3 -5.361-1.134-7.234-2.996-1.862-1.874-2.993-4.387-2.996-7.233v-77.54c3e-3 -2.847 1.134-5.361 2.996-7.235 1.874-1.862 4.387-2.992 7.234-2.996h23.131v9.536c-4e-3 6.669 2.724 12.771 7.097 17.134 4.363 4.374 10.466 7.102 17.135 7.098h9.535v54.003c-4e-3 2.846-1.136 5.359-2.997 7.233z" fill="#232323"/><path transform="translate(-4.1514 -7.6108)" d="m89.023 79.568-46.575 11.207 13.582-45.938z" fill="#ff6b30"/><path d="m77.031 94.328-17.528-3.6901"/><path d="m20.974 7.1571c-0.02356 0.49766-0.13737 2.847-0.18945 5.1967-0.05115 2.3075-0.16722 8.1957 0.72284 13.665 0.43023 2.6436 1.0953 5.2753 2.1267 7.7374 0.93886 2.2412 2.1714 4.3218 3.8137 6.2035 0.0092 0.0105 0.01831 0.02102 0.02743 0.03156 1.4468 1.672 3.1194 3.1304 4.9946 4.4098 1.9609 1.338 4.0975 2.4484 6.3211 3.3761 6.037 2.5187 12.515 3.5622 15.453 3.9904l-2.8598 19.622c-3.1737-0.46255-11.75-1.7745-20.229-5.312-3.2282-1.3469-6.5979-3.0697-9.8619-5.2967-3.1462-2.1467-6.1376-4.7222-8.8132-7.8141l0.02743 0.03156c-3.2113-3.6795-5.5106-7.6351-7.1634-11.581-1.7869-4.2657-2.802-8.4827-3.4092-12.214-1.218-7.484-1.025-15.054-0.97545-17.289 0.058338-2.6328 0.18413-5.2172 0.20674-5.6949z" fill="#ff6b30"/></svg>
EOLONGTEXT;     // $svg_file


$svg_message = <<<EOLONGTEXT
<?xml version="1.0" encoding="UTF-8"?>
<svg width="128px" height="128px" enable-background="new 0 0 128 128" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><rect x="14.452" y="48.744" width="98.696" height="22.406" fill="#ff6b30"/><path d="m118.14 23.125c-3.601-3.61-8.636-5.86-14.142-5.858h-80c-5.505-2e-3 -10.54 2.248-14.142 5.858-3.61 3.603-5.861 8.636-5.858 14.142v45.757c-3e-3 5.507 2.248 10.541 5.858 14.143 3.602 3.61 8.637 5.861 14.142 5.857h2.017l5.654 17.015c0.418 1.333 1.725 1.693 2.938 1.693 1.212 0 2.064-0.698 2.937-1.693l13.989-17.015h52.465c5.506 4e-3 10.542-2.247 14.143-5.857 3.611-3.602 5.86-8.636 5.857-14.143v-45.757c3e-3 -5.506-2.246-10.539-5.858-14.142zm-11.819 58.571c0 1.912-1.545 3.462-3.453 3.462h-77.741c-1.909 0-3.453-1.55-3.453-3.462v-2.743c0-1.913 1.544-3.464 3.453-3.464h77.741c1.908 0 3.453 1.551 3.453 3.464v2.743zm0-20.265c0 1.913-1.545 3.463-3.453 3.463h-77.741c-1.909 0-3.453-1.55-3.453-3.463v-2.744c0-1.912 1.544-3.462 3.453-3.462h77.741c1.908 0 3.453 1.55 3.453 3.462v2.744zm0-20.264c0 1.913-1.545 3.463-3.453 3.463h-77.741c-1.909 0-3.453-1.55-3.453-3.463v-2.744c0-1.912 1.544-3.463 3.453-3.463h77.741c1.908 0 3.453 1.551 3.453 3.463v2.744z" fill="#232323"/></svg>
EOLONGTEXT;     // $svg_message



/* ==========================================
   = long string vars


   ========================================== */


$copyright =  <<<EOLONGTEXT
<span style="color: #7bc74d">Yapfu File Uploader</span> (c) 2022 JF Lemay (all-in-one-php-file)</br>
</br>
<ul>parts include (thanks to) :
<li>[svg icons] from Anastasya Bolshakova, <a href="https://www.iconfinder.com/nastu_bol">https://www.iconfinder.com/nastu_bol</a></li>
<li>[code & many good stuff] are from community <a href="https://stackoverflow.com">https://stackoverflow.com</a></li></ul>
EOLONGTEXT;


$html_footer = <<<EOLONGTEXT
<div class="upload_info">
Yapfu File Uploader (c) 2022 JF Lemay (all-in-one-php-file) <b>[[beta-test]]</b></br>
<span id="status_bar"></span>
</div>
EOLONGTEXT;


$html_modal = <<<EOLONGTEXT
<div id="modalBackground" class="modal-background fade-in">
  <div id="modalContent" class="modal-content">
    <span id="modalBtnClose" class="modal-close">&times;</span>
    <p id="modalText"></p>
  </div>
</div>
EOLONGTEXT;


/* ==========================================
   = js
              scripts

   ========================================== */
$js_script = <<<EOLONGTEXT




// ========================================
// ============ utils
// ========================================


function getLSCookie(cname) {
    let r = localStorage[cname];
    if (r === undefined || r === null)
        return null;
    if (r.startsWith('(boolean)')) {
        return (r.substring(r.indexOf(')') + 1) == 'true');
    }
    if (r.startsWith('(float)')) {
        return parseFloat(r.substring(r.indexOf(')') + 1));
    }
    if (r.startsWith('(number)')) {
        return parseFloat(r.substring(r.indexOf(')') + 1));
    }
    return r;
}

function setLSCookie(cname, cvalue) {
    let typ = typeof cvalue;
    if (typ == 'number') 
        cvalue = '(float)' + cvalue;
    if (typ == 'boolean') 
        cvalue = '(boolean)' + (cvalue ? 'true' : 'false');
    localStorage[cname] = cvalue;
}

function str_nblines( str ){
    if (str=="") return 0;
    return (str.match(/\\n/g) || '').length + 1;
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}



function str_taillines( str, n = 10) {
  if ( str_nblines(str) <= n )  return str;
  return str.split('\\n').slice(-n).join('\\n');  
}



function str_fromDate( d ) {

        // return ("000" + n).slice(-nb);
        function pad2(n) {  return (n < 10 ? '0' : '') + n;    }

        return d.getFullYear() + '-' +
               pad2(d.getMonth() + 1) + '-' + 
               pad2(d.getDate()) + '_' +
               pad2(d.getHours()) + ':' +
               pad2(d.getMinutes()) + ':' +
               pad2(d.getSeconds()) 
          //     + '.' + pad2(d.getMilliseconds(),3)
               ;

}


function post_cmd( cmd, p, session_hash, resolve=null, ontimeout=null, timeout=null )
{

    let form_data = new FormData();
    form_data.append('submit', 'post_Cmd_XMLHttp');
    form_data.append('the_cmd',  cmd );
    form_data.append('hash',  session_hash );
    for (let i=0; i<p.length; i++) {    form_data.append('p'+(i+1),  p[i] );  }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "", true);
        xhttp.ontimeout = function () {
            let err = 'Error timeout cmd '+cmd+'\\n';
            // app.log_error( err );   
            if (ontimeout !== null) ontimeout(err);
        };     
        xhttp.onload = async function(ev) {
            let json = null;
            if (xhttp.status == 200) {
                try {
                    if ( typeof xhttp.response === 'string' )
                        json = JSON.parse(xhttp.response);
                } catch (error) {
                    app.log_error( 'Exception '+error+'\\n' );
                }
            } else {
               app.log_error( 'Error post_cmd '+cmd+' #'+xhttp.onload+'\\n'); 
            }
            if (resolve !== null) resolve(json);
        };
    xhttp.timeout = 1000; // 1sec
    if (timeout !== null) xhttp.timeout = timeout;
    // xhttp._timeStart =  Date.now();
    xhttp.send(form_data);

}

function format_sec( _time ){
    if (_time < 100)        {  _time = _time.toFixed(0)+'ms ';          }  
    else if (_time < 5000)  {  _time = (_time / 1000).toFixed(1)+'s ';  } 
    else                    {  _time = (_time / 1000).toFixed(0)+'s ';  }
    return _time;
}

function format_size(size) {
    let ssize = size / 1024;
    if (ssize < 1024) ssize = ssize.toFixed(0) + 'Kb ';
    else              ssize = (ssize / 1024).toFixed(0) + 'Mb ';
    return ssize;
}

function format_percent(loaded, total) {
        let percentComplete = (loaded / total) * 100;
        if ( percentComplete < 0 ) percentComplete = 0;
        if ( percentComplete > 100 ) percentComplete = 100;
        return percentComplete;
}


function w_post_file(file_obj, session_hash, onprogress, onload) {
    return new Promise((resolve, reject) => {  
        post_file( file_obj, session_hash, onprogress,
            (json) => {     onload( true, json );     resolve(json);            },
            (err)  => {     onload( status );         reject(status);           }   );
    });
}


function post_file(file_obj, session_hash, onprogress=null, resolve=null, reject=null ) {
    let form_data = new FormData();
    form_data.append('submit', 'post_Upload_XMLHttp');
    form_data.append('the_file',  file_obj );
    form_data.append('hash',  session_hash );
    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "", true);
    xhttp.upload.onprogress = function(ev) {  
        if (!ev.lengthComputable)  return;
        let timeStamp =  Date.now() - xhttp._timeStart;  
        let timeFromStart = ( timeStamp / 1000 ).toFixed(0);
        let total = xhttp._file_obj.size;
        let loaded = xhttp._file_obj.size * (ev.loaded / ev.total);
        let totalTime = '';
        if ( loaded >0 ) {  totalTime = ' / '+(  total * timeStamp / loaded /1000  ).toFixed(0)+' sec';   }
        onprogress(timeFromStart, totalTime, format_percent(ev.loaded, ev.total));
    };
    xhttp.onload = async function(ev) {
        onprogress('', '', '100%');
        if (xhttp.status == 200) {
                let json = null;
                try {
                    json = JSON.parse(xhttp.response);
                    json['after_time'] = format_sec(Date.now() - xhttp._timeStart);
                    json['after_size'] = format_size(xhttp._file_obj.size);
                    json['after_name'] = xhttp._file_obj.name;
                } catch (error) {
                    console.error(error);
                    app.log_error( error+'\\n' );
                }
                resolve( json );
        } else {
                reject( xhttp.status );
        }
    }
    xhttp._file_obj = file_obj;
    xhttp._timeStart =  Date.now();
    xhttp.send(form_data);
}




// ========================================
// ============ class Application
// ========================================

class Application {

    constructor() {
        // this.fileobj = null;
        this.dirhash = null;
        this.lastSaveCookie =  Date.now();
        this.lastSetCookie  =  this.lastSaveCookie;
        this.lastCheckDir   =  Date.now();
        this.appInitDate    =  Date.now();
        this.postTimeout    =  1000;
        this.allowed_ext = null;
        this.msg_from_php = null;
        this.upl_maxsize = null;
        this.copyright = null;
        this.session_hash = null;
        this.clientip = null;
    }

    // event
    ev_dropfile(ev) {
        ev.preventDefault();
        ev.currentTarget.classList.remove("drag_style_over");
        this.upload_post_file(ev.dataTransfer.files);
    }

    // event
    ev_choosefile() {
        document.getElementById('selectfile').click();
        document.getElementById('selectfile').onchange = function() {
            app.upload_post_file( document.getElementById('selectfile').files );
        };
    }

    // event
    ev_dragleave(ev) {
        ev.currentTarget.classList.remove("drag_style_over");
    }

    // event
    ev_dragover(ev) {
        ev.preventDefault();
        ev.currentTarget.classList.add("drag_style_over");
        return false;
    }


    // event
    async ev_btndel(ev) {
        post_cmd( 'delete', [ ev.target.value ], this.session_hash,
            (json) => {  
                let m = json['msg']+' ';
                if ( json['error'] != 0 )   {
                    m += json['msg_error'];
                    this.log_error( m+'\\n' );
                } else {
                    this.set_log( m+'\\n' );
                }
                if ('refresh' in json &&  json['error'] == 0 )
                        this.refresh_page();
            },
            () => {},
            this.postTimeout );
    }


    // event
    ev_statusbarmouse(ev) {
        let elt = ev.currentTarget;
        let stbar = document.getElementById('status_bar');
        if (ev.type == 'mouseover')
           stbar.innerText = elt.getAttribute('statusmsg');
        else
           stbar.innerHTML = '&nbsp; ';
    }


    // event
    async ev_btnfile(ev) {
        ev.target.classList.remove('tr_rotating');
        this.refresh_page();
    }


    check_upload_fname(fn) {
        let ext = /(.*\.)([^\.\/]*)$/.exec(fn)[2];
        if (ext === undefined)  ext = '';
        if ( ! this.allowed_ext.includes( ext ) ) {
            this.log_error( "Extension file [" + ext + "] not allowed\\n" );
            return false;        
        } 
        if ( fn.startsWith('.') || fn.includes('..')  || fn.includes('/')  ) {
            this.log_error( "File name [" + fn + "] not allowed\\n" );
            return false;        
        }  
        return true;
    }



    async upload_post_file(files) {

        // if (files.length == 0 || files.length > 1) {
        //    this.log_error('Error please select only one file \\n');
        //    return;
        // }

        let nb_files_tr=0;
        for (let i=0; i<files.length; i++) {
            // ss += `try to send n°\${i}  \\n`;

            let file_obj = files[i];
            if (file_obj === undefined || file_obj === null) continue;

            if (file_obj.size > this.upl_maxsize*1024*1024) {
                let fs = file_obj.size/1024/1024;
                this.log_error( 'Error file size = '+ fs.toFixed(0) + 'Mb > '+ this.upl_maxsize.toFixed(0) +'Mb is too big...\\n' );
                continue;
            }

            if ( !this.check_upload_fname(file_obj.name) ) {
                document.getElementById('drag_upload_file').classList.remove("drag_style_over");
                continue;
            }

            await w_post_file(file_obj, this.session_hash, 
                function (timeFromStart, totalTime, percentComplete) {
                    let span_progress=document.getElementById('span_progress'); 
                    let drag_progressbar=document.getElementById('drag_progressbar'); 
                    let div = drag_progressbar.firstElementChild;

                    if (percentComplete == '100%') {
                        span_progress.innerText = '';
                        div.style.width = '0%';
                        drag_progressbar.style.display="none";
                        return;
                    }

                    span_progress.innerHTML = timeFromStart + totalTime;
                    drag_progressbar.style.display="block";
                    let txt = Math.round(percentComplete).toFixed(0)+'%';
                    div.style.width = txt;
                    if (txt=='0%') txt='&nbsp';
                    div.innerText = txt;
                }, 
                function (status, json) {
                    if (status === true) {
                            let m = json.msg;
                            if (json.after_time != "")   m += ' '+json.after_time;
                            if ( json['error'] != 0 )  {
                                m += ' '+json['msg_error'];
                                app.log_error( m+'\\n' );
                            } else {
                                nb_files_tr++;
                                app.set_log( m+'\\n' );
                            }
                        } else {
                            app.log_error( "Error " + status + " occurred when trying to upload your file" );
                        }
                });


        } // for
        if (nb_files_tr > 0)
                app.refresh_page();

    }

    log_error( str ) {
        // this.set_log( str );
        Modal._this.show( str, 10 );
    }

    set_log( str, alone=false ) {
        let div_msgzone=document.getElementById('id_msgzone'); 
        if (!alone) {
          str = div_msgzone.innerText + str;
          str = str_taillines(str, 10);
        }
        div_msgzone.innerText = str; 
        this.lastSetCookie = Date.now();
        return str;
    }


    get_log() {
        let div_msgzone=document.getElementById('id_msgzone');  
        return div_msgzone.innerText;
    }


    async refresh_page() {
        setLSCookie( 'log_error', this.get_log() );
        window.location.search = '';      // window.location.reload();
    }


    set_pcookie(cname, cvalue) {
        
        return new Promise((resolve, reject) => {  
            post_cmd( 'setpcookie', [ cname, cvalue, typeof cvalue ], this.session_hash,
                (json) => {     resolve(json.pcookie);    },
                (err)  => {     reject(err);              }  );
        });
        
    }


    get_pcookie(cname) {
        
        return new Promise((resolve, reject) => {  
            post_cmd( 'getpcookie', [ cname ], this.session_hash,
                (json) => {     resolve(json.pcookie);   },
                (err)  => {     reject(err);             }  );
        });

    }


    get_dirhash() {

        return new Promise((resolve, reject) => {  
            post_cmd( 'dirhash', [ '' ], this.session_hash,
                (json) => {     resolve(json.dirhash);  },
                (err)  => {     resolve('timeout');     },
                this.postTimeout    );
        });

    }


    async start_new_session() {
        let today = str_fromDate(new Date()) + ' ip=['+this.clientip+']';
        this.set_log( await this.get_pcookie('log_error'), true );
        this.set_log ( '\\n' + today + '\\n' );  // this add a log during start of main    
    }

    saveCookie() {
        if (this.lastSetCookie > this.lastSaveCookie) {
            this.set_pcookie( 'log_error', this.get_log() );
            this.lastSaveCookie = Date.now();            
        }
    }

    async checkDir() {
        if ( this.dirhash == '' ) return;
        let appAge = (Date.now() - this.appInitDate) / 1000;
        let delayCheckDir = (appAge / 30) + 3;                  // test less if time flies
        if (delayCheckDir > 5*60) delayCheckDir = 2*60;         // max test every 2 mn
        if ( (Date.now() - this.lastCheckDir) / 1000 < delayCheckDir) return;

        let btn_home = document.getElementById("btn_home");
        btn_home.classList.add("blink");
        let h = await this.get_dirhash();
        btn_home.classList.remove("blink");
        this.lastCheckDir = Date.now();
        // this.set_log(' + elapse = ' + (Date.now() - this.lastCheckDir) + '\\n' );
        if (h=='timeout') return;

        if ( this.dirhash != h )  { 
            this.dirhash = '';
            btn_home.classList.add("tr_shaking");
        }
    }


    async main() {
        let lsc = getLSCookie('log_error');
        let epoch = Math.floor( Date.now() / 1000 );  // epoch
        let session_time = getLSCookie( 'session_time' );
        if ( lsc == null )  lsc = '';
        this.set_log( lsc+this.msg_from_php, true );   
        this.msg_from_php='';

        if ( getLSCookie( 'session_hash' ) != this.session_hash ||
             epoch - session_time > 60*30  ) {
            setLSCookie( 'session_hash', this.session_hash );
            this.start_new_session();
        }

        setLSCookie( 'session_time', epoch ); 
        // this.set_log ( '++' + str_fromDate(new Date()) + '\\n' );  
        let h = await this.get_dirhash();
        if ( this.dirhash != h )   this.dirhash = h;
    }



} // class Application



// ========================================
// ============ class Modal
// ========================================

class Modal {

    static _this = null;

    constructor() {
        Modal._this = this;
        this.time = 0;
        this.interv = null;
        this.modalBackground  = document.getElementById("modalBackground");
        this.modalText        = document.getElementById("modalText");
        this.btnClose         = document.getElementById("modalBtnClose");
        this.btnClose.onclick        = function() {  Modal._this.hide();   };
        this.modalBackground.onclick = function(ev) {  
            if (ev.target != Modal._this.modalBackground) return;
            Modal._this.hide();   
        };
    }

    _show(timeout) {
        this.modalBackground.style.display = "block";
        this.time = Date.now();
        this.timeout = timeout;
        this.btnClose.classList.remove("blink_me");
        if (!this.interv) {
            this.interv = setInterval(() => { Modal._this.timer(); }, 500);
        }
    }


    show(msg, timeout) {
        modalText.innerText = msg;
        this._show(timeout);
    }

    showHtml(msg, timeout) {
        modalText.innerHTML = msg;
        this._show(timeout);
    }

    hide() {
        this.modalBackground.style.display = "none";
        if (this.interv) {
            clearInterval(this.interv);
            this.interv = null;        
            this.btnClose.classList.remove("blink_me");
        }
    }

    timer(){
        let t = (Date.now() - this.time) / 1000;
        if (t>(this.timeout / 2) && ! this.btnClose.classList.contains("blink_me")) {
            this.btnClose.classList.add("blink_me");
        }
        if (t>this.timeout) {
            this.hide();
            return;
        }
    }

}

// ========================================
// ============ window.onload 
// ========================================

window.onload = async function() {

    new Modal();
    app.main();
    setInterval( async () => {

        app.saveCookie();
        app.checkDir();

    }, app.postTimeout * 1.5);

}

let app = new Application(); 


EOLONGTEXT;     // $js_script


/* ==========================================
   css
              embedded css

   ========================================== */

$html_css = <<<EOLONGTEXT
<!-- ================== CSS ================== -->
<style>

body {
    font-family: sans-serif;
    font-size: 12pt;
}

h1 {
    margin: 0.2em;
}



div.modal-background {
  display: none; 
  position: fixed; 
  z-index: 1; 
  padding-top: 0; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.5); 
}


.fade-in { 
    animation: fade-in 1s; 
}

@keyframes fade-in {
    0% { opacity: 0; }
  100% { opacity: 1; }
}

div.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 1em;
/*  border: 0.5em solid #888;  */
  border-radius: 1em;
  width: fit-content;
  max-width: 85%;
  min-width: 30em;
  top: 10em;
  animation: modal-animation .4s ease-out;
}

@keyframes modal-animation {
  from {top: -10em;}
  to   {top:  10em;}
}

.blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {    opacity: 0;  }
}


span.modal-close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

span.modal-close:hover,
span.modal-close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


span.upl_progress {
}

table.upl_table {
    border-collapse: separate;  
    box-shadow: none;
    background-color: #eee;   
    max-width: 90%;
    min-width: 20em;
    padding: 0.3em;  
    border-spacing: 0;
}

.upl_table thead th {
    background-color: #eee;   
}

div.upl_container {
    background-color: #eee;   
    color: #555;
    font:  normal normal normal 1.2em  sans-serif;
    height: 2.3em;
    width:100%;
    display: flex;
    flex-direction: row;
}

.upl_icon {
    flex-grow: 0; 
    cursor: pointer;
}

div.upl_title {
    display: flex;
    flex-grow: 4; 
 /*   background-color: yellow;  */
    align-items: center;
    padding: 0.7em;
}

.upl_table td {
    border: 0;   
    padding-left: 1em; 
    padding-right: 1em; 
}

form.upl_form {
    display: inline-block;
}

.upl_table tr {
}

.upl_table a, .upl_table a:link {
    background-color: #11ffee00;
}

.upl_table tr:nth-child(even) { 
    background: #eee; 
}

.upl_table tr:nth-child(odd)  { 
    background: #fff; 
}

td.upl_url {
    text-align: left;
}

td.upl_size {
    text-align: right;
}

td.upl_form {
    text-align: center;
}

.drag_style_over {
    border: #555 0.4em dashed !important;   
}

div.divdrag {
  width:20em;
  text-align:center;
  color: white;
  background-color: #ff6b30;
}

.bldrag {
  border: #ddd 0.4em solid;   
  margin: 0.2em auto 0.2em auto;
  border-radius: 1em;
  /*  cursor: copy;  */
}

.bldrag:hover {
    border: #ddd 0.4em dashed;   
}

form.upl_form2 {
    display: inline-block;
}

td.upl_del      button:hover,
form.upl_form2  input[type=button]:hover {
  color: white;
  transform: scale(1.0);
}

td.upl_del     button,
form.upl_form2 input[type=button] {
  background-color: #7bc74d;
  border: none;
  border-radius: 0.5em;
  color: #eee;
  padding: 0.5em;
  transform: scale(0.95);
}


input, button {
    font-family: sans-serif;
    font-size: 1em;
    display: inline-block;
    box-sizing: border-box;
    cursor: pointer;
    transition: 0.1s ease-out;
}


div.msgzone {
 /*   border: #bbb 0.4em solid;   */
    border-radius: 1em;
    background-color: #eee;
    min-height: 3em;
    padding: 0.5em;
    margin: 0.2em auto 0.2em auto;
    width: fit-content;
    min-width: 20em;
}

div.upload_info {
  /*  border: #bbb 0.4em solid;   */
    border-radius: 1em;
    background-color: #eee;
    padding: 0.5em;
    margin: auto;
    width: fit-content;
    min-width: 20em;

}

div.upload_info span {
    color: blue;
}

/* $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ */


/* $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ */


div.progressbar {
    color:#000;
    background-color:#f1f1f1;
    border-radius: 0.5em;
    margin: 0.1em 0.5em;
}

div.progressbar div {
    color:#fff;
    background-color:#4CAF50;
    text-align:center;
    border-radius: 0.5em;
    padding: 0.2em 0em;
}

.blink {
  opacity: 0.8;
  scale: 1.2;
}

.tr_rotateover {
    transition: transform .2s ease-in-out;  
}

.tr_rotateover:hover {
    transform:rotate(15deg);
}

@keyframes rotating {
    from {    transform: rotate(0deg);    }
    to   {    transform: rotate(360deg);  }
}

.tr_rotating {
    animation: rotating 2s linear infinite;
}

@keyframes shaking {
  from {    transform: rotate(-15deg);    }
  to   {    transform: rotate( 15deg);    }
}

.tr_shaking {
  animation: shaking alternate 0.6s linear infinite;
}

</style>
<!-- ================== CSS ================== -->

EOLONGTEXT;     // $html_css



/* ==========================================
   html
            div : the drag-drop element


   ========================================== */
$html_div_dragdrop = <<<EOLONGTEXT
<div id="drag_upload_file" class="divdrag bldrag" ondrop="app.ev_dropfile(event)" ondragover="app.ev_dragover(event)" ondragleave="app.ev_dragleave(event)">
    </br>Drop file here or</br>
    <form class="upl_form2">
        <input type="button" value="Select a file" onclick="app.ev_choosefile()" 
            onmouseover="app.ev_statusbarmouse(event)"  onmouseout="app.ev_statusbarmouse(event)" 
            statusmsg="Select a file to upload" />
        <input type="file" id="selectfile" style="display:none;"/>
    </form>
    </br>
    <span id="span_progress" class="upl_progress"></span>
    </br>
    <div id="drag_progressbar" class="progressbar" style="display:none;">
        <div style="width:0%">&nbsp;</div>
    </div>
    </br>
</div>
EOLONGTEXT;     // $html_div_dragdrop



$html_msgzone = <<<EOLONGTEXT
<div id="id_msgzone" class="msgzone"></div>
EOLONGTEXT;     // $html_msgzone



/** ==========================================
    php
            
    ========================================== */


function urlencode2( $s ) {
    return str_replace( '+', "%20", urlencode($s) );
}


function php_log_error($s) {
    global $msg_from_php;
    $msg_from_php .= $s;
}


function str_php2js( $kk ) {
    if ( is_array($kk) && array() !== $kk ) {
        if ( array_keys($kk) === range(0, count($kk) - 1) ) 
          $json = json_encode( array_values($kk) );
        else
          $json = json_encode( array_values($kk), JSON_FORCE_OBJECT );
        $v = "JSON.parse( '{$json}' )";
    } else if ( is_int($kk) ) {
      $v = $kk;
    } else if ( is_float($kk) )  {
      $v = number_format($kk, 8, '.', '');
    } else if ( is_string($kk) ) {
      $v = str_replace("`", "\`", $kk);   // str_replace('"', '\\"', $kk);
      $v = '`'.$v.'`';            
    }
    return $v;
}


function eval_maxsize() {
    global $upl_maxsize;

    $upl_maxsize = 999999999;
    $m = array();
    if ( preg_match('/([0-9]+)(M)/', ini_get("memory_limit"), $m) ) {
        $upl_maxsize = min ( $upl_maxsize, (int) $m[1] );
    }
    if ( preg_match('/([0-9]+)(M)/', ini_get("upload_max_filesize"), $m) ) {
        $upl_maxsize = min ( $upl_maxsize, (int) $m[1] );
    }
    if ( preg_match('/([0-9]+)(M)/', ini_get("post_max_size"), $m) ) {
        $upl_maxsize = min ( $upl_maxsize, (int) $m[1] );
    }

    $upl_maxsize = (int) ( $upl_maxsize * 0.8 );

    /*
        echo "max_execution_time=" .ini_get("max_execution_time")."</br>\n";
        echo "max_input_time="     .ini_get("max_input_time")."</br></br>\n";        
    */
}


function get_wpath() {
    global $user;
    if ($user == '')  return '-..-' .'/';
    return $user .'/';
}
function get_wdir() {
    global $current_directory;
    global $user;
    if ($user == '')  return $current_directory . '/' .'-..-';
    return $current_directory . '/' .$user;
}

function echo_files() {
    global $allowed_ext;
    global $user;

    $btn_home   = html_btn_svg( 'svg_file',    '1.7em', [['id', 'btn_home'], ['class', 'tr_rotateover upl_icon'],  
        ['onclick', 'app.ev_btnfile(event)'],  ['onmouseover', 'app.ev_statusbarmouse(event)'],  ['onmouseout', 'app.ev_statusbarmouse(event)'],    
        ['statusmsg', 'Reload file list'] ]);   

    $btn_message=html_btn_svg( 'svg_message', '1.7em', [['id', 'btn_message'], ['class', 'tr_rotateover upl_icon'],  
        ['onclick', 'Modal._this.showHtml(app.copyright, 10)'], ['onmouseover', 'app.ev_statusbarmouse(event)'], ['onmouseout', 'app.ev_statusbarmouse(event)'],
        ['statusmsg', 'Show copyright messages'] ]);

    $title='root directory';
    if ($user != '')  $title='[&nbsp;'.$user.'&nbsp;]';
    $title='<div class="upl_title">'.$title.'</div>';

    $scan = [];
    if ( is_dir( get_wdir() ) ) $scan = scandir( get_wdir() );
    if ($scan === false) {
        echo "Error syst scandir [".get_wdir()."] impossible";
        return;
    }

    $files = array_diff($scan, array('.', '..'));
    echo "\n";  // .'<a id="upl_table">';
    echo '<table class="upl_table bldrag" ondrop="app.ev_dropfile(event)" ondragover="app.ev_dragover(event)" ondragleave="app.ev_dragleave(event)">';
    echo '<thead><tr><th colspan="100%"><div class="upl_container">'.$btn_home.$title.$btn_message.'</div></th></tr></thead>';
    echo "<tbody>\n";
    foreach($files as $file){
          $fileExtension = strtolower( pathinfo($file, PATHINFO_EXTENSION) );
          if ( ! in_array($fileExtension, $allowed_ext) )     continue;
          if ( str_starts_with( $file, '.') )                 continue;
          if ( is_dir(get_wdir()."/".$file) )                 continue;

          echo '<tr class="upl_table">'."\n";
          $h_file  = htmlspecialchars( $file );
          $h_fsize = htmlspecialchars( strval( round (filesize( get_wdir()."/".$file ) / 1024) ) . " Kb" );
          echo '<td class="upl_url"><a href="'.get_wpath().urlencode2( $file ).'">'.$h_file.'</a></td>';
          echo '<td class="upl_size">'.$h_fsize.'</td>';
          echo '<td class="upl_del">';
          echo '<button value="'.$h_file.'" onclick="app.ev_btndel(event)">del</button>';
          echo '</td>';
          echo "</tr>\n";
        }
    echo "</tbody>";
    echo "</table>\n";
}


function receive_file_from_POST( &$vars = NULL ) {
    global $allowed_ext;
    global $upl_maxsize;

    if ( !is_array($_FILES) )  return "Error syst";

    $fileName      = $_FILES['the_file']['name'];
    $_fileSize     = $_FILES['the_file']['size'];
    $fileTmpName   = $_FILES['the_file']['tmp_name'];
    $fileType      = $_FILES['the_file']['type'];
    $fileExtension = strtolower( pathinfo($fileName, PATHINFO_EXTENSION) );
    $uploadPath    = get_wdir() ."/". basename($fileName);
    
    if ($_fileSize > 1024*1024)  $fileSize = sprintf("%.0fMb", $_fileSize / 1024 / 1024 );
    else  if ($_fileSize > 1024) $fileSize = sprintf("%.0fKb", $_fileSize / 1024  );
    else                         $fileSize = sprintf("%.0fbytes",   $_fileSize   );

    if ($vars !== NULL) 
        foreach ($vars as $n => $v)     { $vars[ $n ] = $$n; }

    if (is_file( $uploadPath )) 
            return "Error file already exists";        
    
    if (! in_array($fileExtension,$allowed_ext)) 
            return "Error file extension is not allowed";
    
    if ($_fileSize > $upl_maxsize*1024*1024) 
            return "Error file size ({$fileSize}) exceeds maximum size ({$upl_maxsize}Mb)";

    if (preg_match('(\.\.|\/|\:)', $fileName) === 1)  
            return "Error file name contains disallowed substrings [". $fileName ."]";

    try {
        $output = '';
        ob_start();        // ini_set('display_errors', 1);
        $r = move_uploaded_file($fileTmpName, $uploadPath);
        $output = ob_get_clean();
    } catch(Exception $e){
        return "Error ".$e->getMessage().' in '.$e->getFile().' on line '.$e->getLine();
    }
    if (!$r) 
        return "Error = [[[". $output . "]]]";
    return true;
}


function delete_file( $fname ) {
    $fpath = get_wdir() . "/" . $fname;
    if ( preg_match('(\.\.|\/|\:)', $fname) === 1 ) 
        return "Error string contains disallowed substrings.\n" .
              "impossible to delete [". $fpath ."]";
    
    if ( !file_exists( $fpath ) ) 
          return  "Error : file ". $fname ." doesn't exists.";

    try {
        $output = '';
        ob_start();        // ini_set('display_errors', 1);
        $r = unlink( $fpath );
        $output = ob_get_clean();
    } catch(Exception $e){
        return "Error ".$e->getMessage().' in '.$e->getFile().' on line '.$e->getLine();
    }
    if (!$r)  return "Error : delete ". $fname ." #=[[[".$output."]]]";
    
    return true;
}


function html_chg_value( $svg, $array_chg ) {
    // assume tags are formatted with double-quote like this:    tag="value"  (NB: no \" in value)
    $count=0;
    foreach ($array_chg as $v) {
        list($vname, $vv) = $v;
        $count = 0;
        $value = str_replace('"', '&quot;', $vv);
        $svg =  preg_replace( "/({$vname}=\")([^\"]*)(\")/", '${1}'."${value}".'${3}', $svg, 1, $count );
        if ($count == 0)
           $svg =  preg_replace( "/(<[a-zA-Z]+\ )/", "$1{$vname}=\"${value}\" ", $svg, 1 );
    }    
    return $svg;
}


function html_add_tag( $svg, $array_chg ) {
    foreach ($array_chg as $v) {
        list($vname, $value) = $v;
        $svg =  preg_replace( "/(<[a-zA-Z]+\ )/", "$1{$vname}=\"${value}\" ", $svg, 1 );
    }    
    return $svg;
}



function html_btn_svg( $svg_name, $svg_size, $array_chg = [] ) {
    global $$svg_name;
    $array_chg =  array_merge($array_chg,  [ ['width', $svg_size], ['height', $svg_size] ] );
    return html_chg_value( $$svg_name, $array_chg );
}




function init_user() {
    global $user;
    global $current_directory;

    $dir = $current_directory.'/'.'-..-';                // create dir for non-authenticated users
    if ( !is_dir($dir) ) {  mkdir($dir, 0750);   }

    $user='';
    if ( isset($_SERVER['PHP_AUTH_USER']) ) {
        $user=$_SERVER['PHP_AUTH_USER'];
        $dir = $current_directory.'/'.$user;
        if ( !is_dir($dir) ) {    mkdir($dir, 0750);   } // create dir for this user
        if ( !is_dir($dir) ) {    
            $user='';
        } 
    }
}



if (!function_exists('str_starts_with')) {
  function str_starts_with($str, $start) {
    return (@substr_compare($str, $start, 0, strlen($start))==0);
  }
}

// function _str_starts_with( $str, $needle ) {    return substr( $str, 0, strlen($needle) ) === $needle;  }


function getClientIpAddr()  {
    $ip = '0.0.0.0';
    if     (!empty($_SERVER['REMOTE_ADDR']))           {  $ip=$_SERVER['REMOTE_ADDR'];           }
    elseif (!empty($_SERVER['HTTP_CLIENT_IP']))        {  $ip=$_SERVER['HTTP_CLIENT_IP'];        }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  {  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];  }
    return $ip;
}



function help_msg() {
    global $allowed_ext;
    global $user;
    global $upl_maxsize;
    global $locale;

    $s = '<br>\n<br>\n========';    
    $s .= "<br>\nmax file size = {$upl_maxsize} Mb<br>\n";
    $s .= "<br>\nallowed ext = [ ";
    $i=1; foreach($allowed_ext as $v)  {  $s.= "$v ".( ($i++ % 10) ? "" : "<br>\n");   }
    $s .= " ]<br>\n";
    $s .= "locale={$locale}<br>\n";        

    if ($user != '' && isset($_GET['debug']) ) {   // && $_GET['do']=='debug'
        $s .= "<br>\n=== debug stuff follows: ===<br>\n";
        $s .= "memory_limit="       .ini_get("memory_limit")."<br>\n";
        $s .= "upload_max_filesize=".ini_get("upload_max_filesize")."<br>\n";
        $s .= "post_max_size="      .ini_get("post_max_size")."<br>\n";
        $s .= "max_execution_time=" .ini_get("max_execution_time")."<br>\n";
        $s .= "max_input_time="     .ini_get("max_input_time")."<br>\n";        
    }
    $s .= '========';    

    return $s;
}


function send_phpMsg_to_jsMsg() {    
    global $msg_from_php;
    global $allowed_ext;
    global $upl_maxsize;
    global $copyright;       $copyright .= help_msg();
    global $session_hash;
    global $clientip;

    echo "<script>\n";
    $list = [ 'allowed_ext', 'msg_from_php', 'upl_maxsize', 'copyright', 'session_hash', 'clientip' ];
    foreach ( $list as $k ) 
        echo "app.{$k}=".str_php2js( ${$k} ).";\n";
    echo "</script>\n";
}


function init_session() {
    global $session_hash;
    global $locale;
    global $user;
    
    $cookieParams = session_get_cookie_params();
    $cookieParams['samesite'] = 'Strict'; // None, Lax or Strict.
    $cookieParams['httponly'] = true;
    $cookieParams['secure'] = false; // $_SERVER['HTTPS'] ? true : false;
    $cookieParams['domain'] = $_SERVER['HTTP_HOST'];
    $cookieParams['path'] =  '/';
    session_set_cookie_params($cookieParams);
    // ini_set('session.use_strict_mode', 1);
    session_start();    
    $session_hash = hash('sha256', session_id().$user);

    $known_langs = array('en','fr','de','es');
    $locals = [ 'en'=>'en_US.UTF-8', 'fr'=>'fr_FR.UTF-8', 'de'=>'de_DE.UTF-8', 'es'=>'es_ES.UTF-8' ];
    $user_pref_langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

    foreach($user_pref_langs as $idx => $lang) {
        $lang = substr($lang, 0, 2);
        if (in_array($lang, $known_langs)) {
            $locale = $locals[$lang];
            $r = setlocale (LC_ALL, $locale) !== false;    
            // echo "Preferred language is  [$loc]  ($r)\n";
            break;
        }
    }

}

// if success, $r === true, else $r is the string msg_error
// if success, the success msg is in $data['msg']=
function read_post_data_end( $r, $data ) {
    if ( !isset($data['error']) )       $data['error']=0;
    if ( !isset($data['msg']) )         $data['msg']='';
    if ( !isset($data['msg_error']) )   $data['msg_error']='';
    if ( $r !== true ) {
      $data['msg_error'] = $r;
      $data['error'] = 1;
    }
    echo json_encode($data, JSON_FORCE_OBJECT);
}

function sml_mustache( $str, $vars ) {
    foreach ($vars as $n => $v) 
        $str = str_replace( "{{".$n."}}", $v, $str);
    return $str;
}

function get_dirhash() {
    $wdir = get_wdir();
    $files = scandir( $wdir );
    $fh = '';
    foreach($files as $file){
        if ( str_starts_with($file, '.') ) continue;
        $fpath = $wdir."/".$file;
        $ftime = date("YmdHisu", filemtime( $fpath ));
        $fh .= $file.'/';
        $fh .= $ftime.'/';
        $fh .= (string)filesize( $fpath )."\n";
    }
    return md5($fh);
}


function set_pcookie($name, $v) {
    $fpath = get_wdir().'/.cookies';

    try { 
        ob_start();
        $str = file_get_contents($fpath); 
        $output = ob_get_clean();
    }   
    catch (Exception $e) {  
        $str = false;  
    }
    if  ( $str === false ) $str = json_encode( [] );

    $array = json_decode( $str, true );         if ($array === null) $array = [] ;

    $array [ $name ] = $v;
    $str = json_encode( $array );

    try { 
        ob_start();
        $r = file_put_contents( $fpath, $str, LOCK_EX ); 
        $output = ob_get_clean();
    }  
    catch (Exception $e) {
        $r = false;  
    }
    if ($r === false)  return false;  
    return true;
}


function get_pcookie($name) {
    $fpath = get_wdir().'/.cookies';

    try { 
        ob_start();
        $str = file_get_contents($fpath);  
        $output = ob_get_clean();
    }  
    catch (Exception $e) {   
        $str = false;  
    }
    if  ( $str === false) $str = json_encode( [] );

    $array = json_decode( $str, true );
    if ($array === null) $array = [] ;

    if ( isset($array[$name]) )   return $array[ $name ];
    return null;
}


function read_post_data() {
    if ( !isset($_POST['submit']) )  return;

    global $session_hash;
    if ( !isset($_POST['hash']) )  return;
    if ( $_POST['hash'] !=  $session_hash )  {
        header('Content-Type: text/plain; charset=UTF-8');
        read_post_data_end( 'Error session', ['msg' => "post hash"] );
        exit(0);
    }

    if ( $_POST['submit'] ==  "post_Upload_XMLHttp" ) {
        header('Content-Type: text/plain; charset=UTF-8');
        $data = [];
        $vars = [ "fileName"=>NULL, "fileSize"=>NULL ];
        $r = receive_file_from_POST( $vars );
        $msg = sml_mustache("Upload file {{fileName}} ({{fileSize}})", $vars);
        read_post_data_end( $r, [ 'msg' => $msg, 'refresh' => true ] );
        exit(0);
    }

    if ( $_POST['submit'] ==  "post_Cmd_XMLHttp" && isset($_POST['the_cmd'])) {
        header('Content-Type: text/plain; charset=UTF-8');
        $p1 = isset($_POST['p1']) ? $_POST['p1'] : '';
        $p2 = isset($_POST['p2']) ? $_POST['p2'] : '';
        $p3 = isset($_POST['p3']) ? $_POST['p3'] : '';
        switch ($_POST['the_cmd']) {
            case 'delete' :
               read_post_data_end( delete_file( $p1 ), ['msg' => "Delete [{$p1}]", 'refresh' => true] );
               break;
            case 'dirhash' :
                $dir_hash = get_dirhash();
                $r = true;
                if ($dir_hash != $p1)
                    $r = $dir_hash;
                read_post_data_end( $r, ['msg' => "Check dirhash", 'dirhash' => $dir_hash] );
                break;
            case 'setpcookie' :
                switch ($p3) {
                    case 'number':
                        $p2 = (float) $p2;
                        if (floor($p2) == $p2)  $p2 = (int) $p2;
                        break;
                    case 'boolean':
                        $p2 = $p2 == 'true' ? true : false;
                        break;
                }
                $typ1 = gettype($p2);
                read_post_data_end( set_pcookie($p1, $p2), ['msg' => "Set php cookie", 'pcookie' => $p1, 'type' => $typ1 ] );
                break;
            case 'getpcookie' :
                $r = get_pcookie($p1);
                read_post_data_end( $r !== null, ['msg' => "Set php cookie", 'pcookie' => $r] );
                break;
            case '_post' :
               print_r($_POST);
               break;
        }
        exit(0);
    }
}


function main() {
    init_session();
    init_user();
    eval_maxsize();
    read_post_data();

    header('Content-Type: text/html; charset=UTF-8');
    echo "<!DOCTYPE html>\n";
    echo "<html>\n";
    echo "<head>\n";
    global $html_header;       echo $html_header;
    global $html_css;          echo $html_css;
    echo "</head>";

    echo "<body>";
    echo "<script>\n";
    global $js_script;         echo $js_script;
    echo "</script>\n";

    // ====== html page ========
    global $user;
    $title='[[[ no $user : root dir ! ]]]';
    if ($user != '')  $title='[&nbsp;'.$user.'&nbsp;]';
    echo "<h1 style=\"text-align:center;\">${title}</h1>\n";
    // echo '<h3>(v2022-06-30) alpha-test: status in dev </h3>';
    global $html_div_dragdrop; echo $html_div_dragdrop;
    echo_files();
    global $html_msgzone;       echo $html_msgzone;
    global $html_modal;         echo $html_modal;
    global $html_footer;        echo $html_footer;
    // ====== html page ========

    send_phpMsg_to_jsMsg();
    echo "</body>\n";
    echo "</html>\n";
}



    main();
?>
