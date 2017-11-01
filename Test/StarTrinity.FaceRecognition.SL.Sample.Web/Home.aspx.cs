using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace StarTrinity.FaceRecognition.SL.Sample.Web
{
	public partial class Home : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
			var c = new FaceRecognitionServiceReference.FaceRecognitionServiceSoapClient();
			var token = Session["starTrinityToken"];
			var email = c.GetLoggedInUser((string)token);  // this will be null if user's face is not verified on cloud server
			if (String.IsNullOrEmpty(email))
				Response.Redirect("Login.aspx"); // not authenticated user
			emailLabel.Text = email;

		}
	}
}