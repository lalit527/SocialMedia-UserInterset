<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="DeleteAccount.aspx.cs" Inherits="StarTrinity.FaceRecognition.SL.Sample.Web.DeleteAccount" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
    </form>
	<div>
		<a href="Login.aspx">Login</a>|
		<a href="Register.aspx">Register</a>|
		<a href="DeleteAccount.aspx">Delete account</a>
	</div>
    <div>
		<object data="data:application/x-silverlight-2," type="application/x-silverlight-2" style="width:100%; min-height:700px;" >
		  <param name="source" id="source" runat="server" value="ClientBin/StarTrinity.FaceRecognition.SL.Sample.xap"/>
		 
		  <param name="background" value="white" />
		  <param name="minRuntimeVersion" value="4.0.50826.0" />
		  <param name="autoUpgrade" value="true" />
          <param name="background" value="transparent" />
          <param name="windowless" value="true" />
          <param name="initparams" id="initParams" runat="server" value=""/>

		  <a href="http://go.microsoft.com/fwlink/?LinkID=149156&v=4.0.50826.0" style="text-decoration:none">
 			  <img src="http://go.microsoft.com/fwlink/?LinkId=161376" alt="Get Microsoft Silverlight" style="border-style:none"/>
		  </a>
	    </object>
    </div>
</body>
</html>
