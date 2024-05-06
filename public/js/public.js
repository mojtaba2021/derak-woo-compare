jQuery(document).ready(function ($) {
  var parent = $(".dwpc-card-buttons").parent();
  console.log(parent);
  parent.hover(
    function () {
      $(this).find(".dwpc-card-buttons").addClass("opacity-visible-transform");
    },
    function () {
      $(this)
        .find(".dwpc-card-buttons")
        .removeClass("opacity-visible-transform");
    }
  );
  function checkCookie() {
    if (document.cookie.indexOf("dwpc_comparison_products") !== -1) {
      comparisonProducts = JSON.parse(getCookie("dwpc_comparison_products"));

      $(".dwpc-btn-compare").each(function () {
        if (comparisonProducts.includes($(this).data("product-id"))) {
          $(this).addClass("added");
        }
      });
    }
  }
  checkCookie();
  // add the product to the comparison
  function addToComparison(productId) {
    comparisonProducts = [];
    checkCookie();
    comparisonProducts.push(productId);
    comparisonProducts = JSON.stringify(comparisonProducts);
    setCookie("dwpc_comparison_products", comparisonProducts, 50);
  }

  function removeFromComparison(productId) {
    comparisonProducts = [];
    checkCookie();
    comparisonProducts.splice(comparisonProducts.indexOf(productId), 1);
    comparisonProducts = JSON.stringify(comparisonProducts);
    setCookie("dwpc_comparison_products", comparisonProducts, 50);
  }
  function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
  }

  $(".dwpc-btn-compare").click(function (e) {
    if ($(this).hasClass("added")) {
      return;
    }
    e.preventDefault();
    var productId = $(this).data("product-id");
    var compare = $(this);
    compare.addClass("loading");
    setTimeout(function () {
      compare.removeClass("loading");
      compare.addClass("added");
      addToComparison(productId);
    }, 500);
  });

  $(".dwpc-btn-remove-compare").click(function (e) {
    e.preventDefault();
    var productId = $(this).data("product-id");
    var remove = $(this);
    remove.addClass("loading");
    setTimeout(function () {
      remove.removeClass("loading");
      removeFromComparison(productId);
      location.reload();
    }, 700);
  });
});
