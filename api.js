

var page=1;

getTitle();
// getAll();

function getTitle(){
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost:3000/comments");
  xhr.send();
  xhr.responseType = "json";
  xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {

        const data = xhr.response;
        var numTable = data.length;
        const tableSpace= document.getElementById("tableSpace");
        tableSpace.innerHTML = "";
        console.log(data);
        data.forEach(item => {
          tableSpace.innerHTML += "<div id=\"divTab-"+item.id+"\"><h3>"+item.table+"</h3><table><thead id=\"table-"+item.id+"\"></thead></table></div>";

          // document.getElementById("table-"+data.id).innerHTML = data.title;
          getAll(item.id);
        });

        // document.getElementById("ciao").innerHTML = data[1].title;

    } else {
      console.log(`Error: ${xhr.status}`);
    }
  };
}

function getAll(tableId){
  // const numTable = getTitle();
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost:3000/posts?_filter=table_eq="+tableId+"&_page="+page+"&_limit=100&_sort=views");
  xhr.send();
  xhr.responseType = "json";
  xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {

        const data = xhr.response;
        console.log(data);

        // document.getElementById("ciao").innerHTML = data[0].title;
        // const tbody = HTMLElement()

        table = document.getElementById("table-"+tableId);

        table.innerHTML ="";

        for(var i=1;i<data.length;i++){
          table.innerHTML += "<tr><td>"+ data[i].id +"</td><td>"+ data[i].title +"</td><td>"+ data[i].views +"</td></tr>";
        }


    } else {
      console.log(`Error: ${xhr.status}`);
    }
  };
}

function next(){
  page= page+1;
  getAll();
}

function prev(){
  if(page>1){
    page= page-1;
    getAll();
  }
}

function putt(){
    // const xhr = new XMLHttpRequest();
    // xhr.open("POST", "http://localhost:3000/posts");
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // const body = JSON.stringify({
    // title: "Hello World",
    // views: 200
    // });
    // xhr.onload = () => {
    // if (xhr.readyState == 4 && xhr.status == 201) {
    //     console.log(JSON.parse(xhr.responseText));
    // } else {
    //     console.log(`Error: ${xhr.status}`);
    // }
    // };
    // xhr.send(body);

    const options = {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            title: "Hello Worl",
            views: 200
        }),
    };

    fetch('http://localhost:3000/posts', options)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        getAll();
      })
      .catch(error => console.error('Error:', error));
}