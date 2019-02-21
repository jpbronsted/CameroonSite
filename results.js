var config = {
    apiKey: "AIzaSyDNZPsyBA-NyyTZxUGo5CesX4aK-7jpEC4",
    authDomain: "cameroonsite-5f7e2.firebaseapp.com",
    databaseURL: "https://cameroonsite-5f7e2.firebaseio.com",
    projectId: "cameroonsite-5f7e2",
    storageBucket: 'gs://cameroonsite-5f7e2.appspot.com/'
};

firebase.initializeApp(config);

var storage = firebase.app().storage();
var storage_ref = storage.ref();
var db = firebase.firestore();

function initialize(){
    var doctype = document.getElementById('doctype').value;
    var province = document.getElementById('province').value;

    get_documents(doctype, province);
}

function get_documents(doctype, province){
    var url = 'counties';
    var documents_array = [];
    var docRef = db.collection(url);

    if(province !== 'all') {
        url += '/'+province;
        docRef = db.doc(url);
    } else {
        //TODO
    }


    docRef.get().then( function(doc) {
        if( doctype !== 'Show All Documents') {
            if(doctype === 'Audio Recordings'){
                doctype = 'Audio';
            }
            documents_array = doc.get(doctype);
            documents_array.forEach(function(single_doc) {
                storage_ref.child(single_doc).getDownloadURL().then(function(url) {
                    var body = document.getElementsByTagName('body')[0];
                    var figure = document.createElement('figure');
                    var caption = document.createElement('figcaption');
                    var link = document.createElement('a');
                    var item = null;
                    var title = document.createElement('b');
                    var url_string = decodeURIComponent(url);

                    if(doctype === 'Photos') {
                        item = document.createElement('img');

                    } else if(doctype === 'Videos') {
                        item = document.createElement('video');
                        item.innerHTML = 'Please switch your browser to Chrome or Firefox';
                        item.controls = true;
                    } else if(doctype === 'Audio') {
                        item = document.createElement('audio');
                        item.innerHTML = 'Please switch your browser to Chrome or Firefox';
                        item.controls = true;
                    }

                    item.src = url;
                    link.href = url;
                    link.innerHTML = 'View Document';
                    title.innerHTML = url_string.substring(url_string.lastIndexOf('/') + 1, url_string.lastIndexOf('.'));
                    title.innerHTML += '\t';

                    caption.appendChild(title);
                    caption.appendChild(link);
                    figure.appendChild(item);
                    figure.appendChild(caption);

                    body.appendChild(figure);

               }).catch(function(error) {
                 console.log(error);
               });
            });
        } else {
            documents_array = doc.get('Photos');
            Array.prototype.push.apply(documents_array, doc.get('Videos'));
            Array.prototype.push.apply(documents_array, doc.get('Audio'));

            documents_array.forEach(function(single_doc) {
                storage_ref.child(single_doc).getDownloadURL().then(function(url) {
                    var body = document.getElementsByTagName('body')[0];
                    var figure = document.createElement('figure');
                    var caption = document.createElement('figcaption');
                    var link = document.createElement('a');
                    var item = null;
                    var title = document.createElement('b');
                    var doctype = single_doc.substring(0, single_doc.indexOf('/'));

                    if(doctype === 'Photos') {
                        item = document.createElement('img');

                    } else if(doctype === 'Videos') {
                        item = document.createElement('video');
                        item.innerHTML = 'Please switch your browser to Chrome or Firefox';
                        item.controls = true;
                    } else if(doctype === 'Audio') {
                        item = document.createElement('audio');
                        item.innerHTML = 'Please switch your browser to Chrome or Firefox';
                        item.controls = true;
                    }

                    item.src = url;
                    link.href = url;
                    link.innerHTML = 'View Document';
                    title.innerHTML = single_doc.substring(single_doc.lastIndexOf('/') + 1, single_doc.lastIndexOf('.'));
                    title.innerHTML += '\t';

                    caption.appendChild(title);
                    caption.appendChild(link);
                    figure.appendChild(item);
                    figure.appendChild(caption);

                    body.appendChild(figure);

                }).catch(function(error) {
                    console.log(error);
                });
            });
        }
    })
    .catch(function(error) {
        console.log("Error getting documents: ", error);
    });
}

function submit_form(name, id, form) {
  if (name != 'Show All Documents' && name != 'Show all provinces')
    document.getElementById(id).value = name;
  else
    document.getElementById(id).value = "";
  form.submit();
}
