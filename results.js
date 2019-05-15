// Generates a UI element for a particular media in the UI framework
function genUI(path, url) {
  if (typeof(genUI.counter) == 'undefined')
    genUI.counter = 0;
  let node = null;
  switch (path.substring(path.indexOf('.'))) {
    case '.png':
      node = document.createElement('img');
      node.src = url;
      break;
    case '.mp4':
      node = document.createElement('video');
      node.src = url;
      node.controls = true;
      node.innerHTML = 'Please switch your browser to Chrome or Firefox';
      break;
    case '.mp3':
      node = document.createElement('audio');
      node.controls = true;
      let subnode = document.createElement('SOURCE');
      subnode.src = url;
      subnode.type = 'audio/mp4';
      node.appendChild(subnode);
      break;
    default:
      return;
  }
  if (!(genUI.counter % 3)) {
    genUI.currRow = document.createElement('DIV');
    genUI.currRow.classList.add('row');
    document.getElementById('ui-container').appendChild(genUI.currRow);
  }
  var currCol = document.createElement('DIV');
  currCol.classList.add('col-sm');
  currCol.style.textAlign = 'center';
  currCol.appendChild(node);
  genUI.currRow.appendChild(currCol);
  genUI.counter++;
}

// Initialize Firebase connection
firebase.initializeApp({
  apiKey: "AIzaSyDNZPsyBA-NyyTZxUGo5CesX4aK-7jpEC4",
  authDomain: "cameroonsite-5f7e2.firebaseapp.com",
  databaseURL: "https://cameroonsite-5f7e2.firebaseio.com",
  projectId: "cameroonsite-5f7e2",
  storageBucket: "cameroonsite-5f7e2.appspot.com",
  messagingSenderId: "626188095181",
  appId: "1:626188095181:web:4c32d3feab5e8193"
});
var firestore = firebase.firestore();
var storage = firebase.storage().ref();

// We enclose the script functionality in a function so it can be run after
// certain DOM elements are loaded
function run() {
  // Get the currently selected doctype and province fields
  var doctype = document.getElementById('type-selector').value;
  var province = document.getElementById('prov-selector').value;

  var doctype_list = [];
  var province_list = []
  var exts = { 'all' : '' };
  var promises = [];

  // Populate the 'sort by document' dropdown
  promises.push(firestore.collection('doctypes').get().then(function(docs) {
    docs.forEach(function(doc) {
      let node = document.createElement('OPTION');
      node.value = doc.id;
      node.innerHTML = doc.id;
      if (doctype === doc.id)
        node.selected = true;
      document.getElementById('doctype').appendChild(node);
      // Keep a list of doctypes so we can use it later for queries
      doctype_list.push(doc.id);
      exts[doc.id] = doc.data().ext;
    });
  }).catch(function(error) {
    console.log('Error processing social media documents: ' + error);
  }));

  // Fetch the map coordinates data
  promises.push(firestore.collection('counties').get().then(function(docs) {
    docs.forEach(function(doc) {
      let node = document.createElement('OPTION');
      node.value = doc.id;
      node.innerHTML = doc.id;
      if (province === doc.id)
        node.selected = true;
      document.getElementById('province').appendChild(node);
      // Keep a list of provinces so we can use it later for queries
      province_list.push(doc.id);
    });
  }).catch(function(error) {
    console.log('Error processing info document: ' + error);
  }));

  Promise.all(promises).then(function() {
    var province_query = (province === 'all') ? province_list : [ province ];
    var results = {};

    // Query on the selected fields and generate UI elements
    province_query.forEach(function(prov) {
      firestore.collection('counties').doc(prov).get().then(function(county) {
        if (!county.exists)
          throw new Error('Error fetching county document');
        county.data().paths.forEach(function(path) {
          if (path.includes(exts[doctype]))
            storage.child(path).getDownloadURL().then(function(url) {
              genUI(path, url);
            });
        });
      });
    });
  }).catch(function(error) {
    console.log('Error rendering UI: ' + error);
  });
}
