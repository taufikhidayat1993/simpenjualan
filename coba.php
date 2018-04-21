
<!DOCTYPE html>
<html>
    <head>
        <title> Set Background Color To Selected Table TR </title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>
            
             tr{cursor: pointer; transition: all .25s ease-in-out}
            .selected{background-color: red; font-weight: bold; color: #fff;}
            
        </style>
        
    </head>
    <body>
        
        <table id="table" border="1">
            
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
            </tr>
            <tr>
                <td>A1</td>
                <td>B1</td>
                <td>C1</td>
            </tr>
            <tr>
                <td>A2</td>
                <td>B2</td>
                <td>C2</td>
            </tr>
            <tr>
                <td>A3</td>
                <td>B3</td>
                <td>C3</td>
            </tr>
            <tr>
                <td>A4</td>
                <td>B4</td>
                <td>C4</td>
            </tr>
            <tr>
                <td>A5</td>
                <td>B5</td>
                <td>C5</td>
            </tr>
            <tr>
                <td>A6</td>
                <td>B6</td>
                <td>C6</td>
            </tr>
            <tr>
                <td>A7</td>
                <td>B7</td>
                <td>C7</td>
            </tr>
            <tr>
                <td>A8</td>
                <td>B8</td>
                <td>C8</td>
            </tr>
            
        </table>
        
        <script>
            
            function selectedRow(){
                
                var index,
                    table = document.getElementById("table");
            
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         // remove the background from the previous selected row
                        if(typeof index !== "undefined"){
                           table.rows[index].classList.toggle("selected");
                        }
                        console.log(typeof index);
                        // get the selected row index
                        index = this.rowIndex;
                        // add class selected to the row
                        this.classList.toggle("selected");
                        console.log(typeof index);
                     };
                }
                
            }
            selectedRow();
        </script>
    </body>
</html>