window.onload = function () {
    jQuery('pre').each(function(i, block) {
      hljs.highlightBlock(block);
    });
}
