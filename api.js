var pager={};

var ff=0;

getTitle();

function getTitle(){

  const xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost:3000/comments");
  xhr.send();
  xhr.responseType = "json";
  xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {

        const data = xhr.response;
        ff= data.length;
        const tableSpace= document.getElementById("tableSpace");
        tableSpace.innerHTML = "";
        console.log(data);
        let index = 0;
        data.forEach(item => {
          if(data.length>0){
            pager[index]= {
              page: 1,
              tableId: item.id
            };
            
            tableSpace.innerHTML += "<div class=\"tableDiv\" id=\"divTab-"+item.id+"\"><h3 class=\"centrato\">"+item.table+"</h3><table class=\"borderer\"><thead><tr id=\"thead-"+item.id+"\"></tr></thead><tbody><tr id=\"table-"+item.id+"\"></tr></tbody></table><button id=\"prev-"+item.id+"\" onclick=\"prev("+item.id+")\">prev</button> <button id=\"next-"+item.id+"\" onclick=\"next("+item.id+")\">next</button></div>"; //<tr><th class=\"borderer\">ID</th><th class=\"borderer\">Title</th><th class=\"borderer\">Views</th><th class=\"borderer\">Table</th></tr>

            thead = document.getElementById("thead-"+item.id);

            for(var i=0;i<item.th.length;i++){
              thead.innerHTML += "<th class=\"borderer\">"+ item.th[i] +"</th>";
            }
          }else{
            tableSpace.innerHTML = "no table";
          }

          getAll(item.id);
          index++;
        });

    } else {
      console.log(`Error: ${xhr.status}`);
    }
  };
}

function getAll(tableId){

  var page=1;
  for(i=0;i<ff;i++){
    if(pager[i].tableId == tableId){
      page= pager[i].page;
      break;
    }
  }
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost:3000/posts?table="+tableId+"&_page="+page+"&_limit=1"); //&_sort=views
  xhr.send();
  xhr.responseType = "json";
  xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {

        const data = xhr.response;
        console.log(data);

        table = document.getElementById("table-"+tableId);

        if(table){
          table.innerHTML ="";

          if(data.length>0){

            let index = 0;
            data.forEach(item => {

              table.innerHTML += "<td>"+ item.id +"</td>";

              for(var i=0;i<item.data.length;i++){
                table.innerHTML += "<td>"+ item.data[i] +"</td>";
              }
            });
          }else{
            table.innerHTML = "<tr class=\"borderer\"><p class=\"borderer\">ddddd</p></tr>"
          }

        } 


    } else {
      console.log(`Error: ${xhr.status}`);
    }
  };
}

function next(tableId){

  for(i=0;i<ff;i++){
    if(pager[i].tableId == tableId){
      pager[i].page= pager[i].page+1;
    }
  }

  getAll(tableId);
}

function prev(tableId){

  for(i=0;i<ff;i++){
    if(pager[i].tableId == tableId && pager[i].page>1){
      pager[i].page= pager[i].page-1;
      getAll(tableId);
    }
  }
}

function putt(){

    var title = document.getElementById("title").value;

    var views = document.getElementById("views").value;

    var table = document.getElementById("table").value;

    if(title!="" && views!="" && table!=""){
      debugger;
      const options = {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            title: title,
            views: views,
            table: table
        }),
      };

      fetch('http://localhost:3000/posts', options)
        .then(response => response.json())
        .then(data => {
          console.log(data);
          getAll(table);
        })
        .catch(error => console.error('Error:', error));

    }
    else{
      console.log("campi mancanti")
    }

}