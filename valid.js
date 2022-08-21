function validate()
{
	const f=document.getElementById("fn");
	const l=document.getElementById("ln");
	const g=document.getElementById("g");
	const p=document.getElementById("em");
	const x=document.getElementById("pn");

	if(f.value.length < 2 || f.value.length > 20)
	{
		alert("Please Enter The Value");
		f.focus();
		return fales;
	}
	if(l.value.length < 2 || l.value.length > 20)
	{
		alert("Please Enter The Value");
		l.focus();
		return fales;
	}
	if(g.value == "")
	{
		alert("Please Enter The Value");
		return fales;
	}
	if(p.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))
	{
		alert("Please Enter The Value");
		p.focus();
		return fales;
	}
	if(!x.value.match(/^[1-9][0-9]{9}$/))
	{
		alert("Please Enter The Value");
		x.focus();
		return fales;
	}
	<!--var atposition=x.indexOf("@");
	var dotposition=x.lastIndexOf(".");
	if(atposition<1||dotpostion<atposition+2||dotpostion+2>=x.length)
	{
		alert("Please enter a valid e-mail address\n atposition:"+atposition+"\n dotposition:"+dotposition);
		return fales;
	}-->
}