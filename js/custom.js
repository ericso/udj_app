

function preparePage() {
	document.getElementById("plus").onclick = function() {
        if ( document.getElementById("plus").className == "btn btn-small active") {
             document.getElementById("plus").className = "btn btn-small";
        } else {
           document.getElementById("plus").className = "btn btn-small active";
           document.getElementById("minus").className = "btn btn-small";
        }
	};
	document.getElementById("minus").onclick = function() {
        if ( document.getElementById("minus").className == "btn btn-small active") {
             document.getElementById("minus").className = "btn btn-small";
        } else {
           document.getElementById("minus").className = "btn btn-small active";
           document.getElementById("plus").className = "btn btn-small";
        }
	};	
	document.getElementById("plus2").onclick = function() {
        if ( document.getElementById("plus2").className == "btn btn-small active") {
             document.getElementById("plus2").className = "btn btn-small";
        } else {
           document.getElementById("plus2").className = "btn btn-small active";
           document.getElementById("minus2").className = "btn btn-small";
        }
	};
	document.getElementById("minus2").onclick = function() {
        if ( document.getElementById("minus2").className == "btn btn-small active") {
             document.getElementById("minus2").className = "btn btn-small";
        } else {
           document.getElementById("minus2").className = "btn btn-small active";
           document.getElementById("plus2").className = "btn btn-small";
        }
	};	
	document.getElementById("plus3").onclick = function() {
        if ( document.getElementById("plus3").className == "btn btn-small active") {
             document.getElementById("plus3").className = "btn btn-small";
        } else {
           document.getElementById("plus3").className = "btn btn-small active";
           document.getElementById("minus3").className = "btn btn-small";
        }
	};
	document.getElementById("minus3").onclick = function() {
        if ( document.getElementById("minus3").className == "btn btn-small active") {
             document.getElementById("minus3").className = "btn btn-small";
        } else {
           document.getElementById("minus3").className = "btn btn-small active";
           document.getElementById("plus3").className = "btn btn-small";
        }
	};	
	document.getElementById("plus4").onclick = function() {
        if ( document.getElementById("plus4").className == "btn btn-small active") {
             document.getElementById("plus4").className = "btn btn-small";
        } else {
           document.getElementById("plus4").className = "btn btn-small active";
           document.getElementById("minus4").className = "btn btn-small";
        }
	};
	document.getElementById("minus4").onclick = function() {
        if ( document.getElementById("minus4").className == "btn btn-small active") {
             document.getElementById("minus4").className = "btn btn-small";
        } else {
           document.getElementById("minus4").className = "btn btn-small active";
           document.getElementById("plus4").className = "btn btn-small";
        }
	};	
	document.getElementById("plus5").onclick = function() {
        if ( document.getElementById("plus5").className == "btn btn-small active") {
             document.getElementById("plus5").className = "btn btn-small";
        } else {
           document.getElementById("plus5").className = "btn btn-small active";
           document.getElementById("minus5").className = "btn btn-small";
        }
	};
	document.getElementById("minus5").onclick = function() {
        if ( document.getElementById("minus5").className == "btn btn-small active") {
             document.getElementById("minus5").className = "btn btn-small";
        } else {
           document.getElementById("minus5").className = "btn btn-small active";
           document.getElementById("plus5").className = "btn btn-small";
        }
	};	
}

window.onload =  function() {
	preparePage();
};

var searchField = document.getElementById("artistTitle");

searchField.onfocus = function() {
	searchField.value = ""; 	 
	};

searchField.onblur = function() {
	searchField.value = "Artist or Title" 
	};

window.onload = function(){
	searchField.value = "Artist or Title"
	};