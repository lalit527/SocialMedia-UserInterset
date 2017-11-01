using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace StarTrinity.FaceRecognition.SL.Sample.Web
{
	public partial class DeleteAccount : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
			// server2server call
			var c = new FaceRecognitionServiceReference.FaceRecognitionServiceSoapClient();
			var token = c.VerifyAppIdAndGetToken("trial", "trial"); // todo: insert your application ID and password here
			Session["starTrinityToken"] = token;
			initParams.Attributes.Add("value", String.Format("token={0},mode=login,redirect=null", token));	
		}
	}
}