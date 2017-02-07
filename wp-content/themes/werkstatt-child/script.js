window.onload = function () {
    jQuery('code').each(function(i, block) {
      hljs.highlightBlock(block);
    });
}
