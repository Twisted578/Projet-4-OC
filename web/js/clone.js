var i = 1;
function duplic(element) {
    i++;
    clone = document.getElementById(element).cloneNode(true);
    clone.name = element + '_' + i;
}
