$("#users").html("<h3>Loading Users...</h3>");

fetch("https://jsonplaceholder.typicode.com/users")

.then(function(response){

    return response.json();

})

.then(function(data){

    let output="";

    for(let i=0;i<data.length;i++){

        output += `

        <div class="col-md-4">

            <div class="card p-3 shadow">

                <img src="https://i.pravatar.cc/150?img=${i+1}" class="rounded-circle mx-auto" width="100">

                <h4 class="text-center mt-2">${data[i].name}</h4>

                <p><b>Email:</b> ${data[i].email}</p>

                <p><b>Phone:</b> ${data[i].phone}</p>

                <p><b>Company:</b> ${data[i].company.name}</p>

            </div>

        </div>

        `;

    }

    $("#users").html(output);

    $("#totalUsers").html("Total Users : " + data.length);

})

.catch(function(){

    $("#users").html("<h3>Unable to Load Users</h3>");

});