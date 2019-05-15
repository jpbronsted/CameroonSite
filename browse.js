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

// Populate the 'sort by document' dropdown
firestore.collection('doctypes').get().then(function(docs) {
  docs.forEach(function(doc) {
    let node = document.createElement('OPTION');
    node.value = doc.id;
    node.innerHTML = doc.id;
    document.getElementById('doctype').appendChild(node);
  });
}).catch(function(error) {
  console.log('Error processing social media documents: ' + error);
});

// Fetch the map coordinates data
firestore.collection('counties').get().then(function(docs) {
  docs.forEach(function(doc) {
    let node = document.createElement('AREA');
    node.shape = 'polygon';
    node.coords = doc.data().coords;
    node.onclick = function() {
      submit_form(doc.id, 'prov-selector',
          document.getElementById('results-form'));
    }
    console.log(node.onclick);
    node.style = 'outline: none;';
    document.getElementById('bmap').appendChild(node);
  });
}).catch(function(error) {
  console.log('Error processing info document: ' + error);
});
