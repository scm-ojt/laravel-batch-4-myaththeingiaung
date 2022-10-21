let input = document.getElementById('title');
let btn = document.getElementById('search');
search.disabled = true;
input.addEventListener('focus',function(){
    search.disabled = false;
});
if(input.value.length > 0){
    search.disabled = false;
}
