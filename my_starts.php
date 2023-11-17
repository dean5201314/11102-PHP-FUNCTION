<style>
    * {
        font-family: 'Courier New', Courier, monospace;
        /* line-height: 10px; */
    }
</style>
<h2>正三角形</h2>
<?php

equilateral_triangle(5);
equilateral_triangle(9);
equilateral_triangle(13);

function equilateral_triangle($size){
    for($i=0;$i<$size;$i++) {
        for($j=0;$j<($size-1-$i);$j++) {
            echo "&nbsp;";
        }
        for($k=0;$k<($i*2+1);$k++) {
            echo "*";
        }
        echo "<br>";
    }
}


// function diamond($size){
//     for($i=0;$i<$size;$i++) {
//         for($j=0;$j<($size-1-$i);$j++) {
//             echo "&nbsp;";
//         }
//     }
//     for($k=0;$k<($i*2+1);$k++) {
//         echo "*";
//     }
//     echo "<br>";
// }

?>