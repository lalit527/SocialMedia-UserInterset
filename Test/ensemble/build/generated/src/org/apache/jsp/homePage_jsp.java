package org.apache.jsp;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;

public final class homePage_jsp extends org.apache.jasper.runtime.HttpJspBase
    implements org.apache.jasper.runtime.JspSourceDependent {

  private static final JspFactory _jspxFactory = JspFactory.getDefaultFactory();

  private static java.util.List<String> _jspx_dependants;

  private org.glassfish.jsp.api.ResourceInjector _jspx_resourceInjector;

  public java.util.List<String> getDependants() {
    return _jspx_dependants;
  }

  public void _jspService(HttpServletRequest request, HttpServletResponse response)
        throws java.io.IOException, ServletException {

    PageContext pageContext = null;
    HttpSession session = null;
    ServletContext application = null;
    ServletConfig config = null;
    JspWriter out = null;
    Object page = this;
    JspWriter _jspx_out = null;
    PageContext _jspx_page_context = null;

    try {
      response.setContentType("text/html");
      pageContext = _jspxFactory.getPageContext(this, request, response,
      			null, true, 8192, true);
      _jspx_page_context = pageContext;
      application = pageContext.getServletContext();
      config = pageContext.getServletConfig();
      session = pageContext.getSession();
      out = pageContext.getOut();
      _jspx_out = out;
      _jspx_resourceInjector = (org.glassfish.jsp.api.ResourceInjector) application.getAttribute("com.sun.appserv.jsp.resource.injector");

      out.write("\n");
      out.write("<!DOCTYPE html>\n");
      out.write("<html><meta charset=\"utf-8\" />\n");
      out.write("<head><title>Welcome to ensemble</title>\n");
      out.write("<style>\n");
      out.write("h1 {text-shadow:2px 2px #FFb842;}\n");
      out.write("</style>\n");
      out.write("\n");
      out.write("<link rel=\"shortcut icon\" href=\"favicon2.png\"  type=\"image/png\"  >\n");
      out.write("\n");
      out.write("<style>\n");
      out.write("a:link {text-decoration:none;}    \n");
      out.write("a:visited {text-decoration:none;} \n");
      out.write("a:hover {text-decoration:underline;}   \n");
      out.write("a:active {text-decoration:underline;}  \n");
      out.write("</style>\n");
      out.write("\n");
      out.write("</head>\n");
      out.write("<body>\n");
      out.write("<div id=\"container\" width:1000px>\n");
      out.write("<div id=\"header\" style=\"background-color:#6685ab;\">\n");
      out.write("<h1 style=\"margin-bottom:20;\">ens&eacutembl&eacute</h1>\n");
      out.write("\n");
      out.write("<div id=\"content\" style=\"background-color:#6685ab;\">\n");
      out.write(" &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp        \n");
      out.write("<img src=\"together.png\" height=550px; width=585.5px align:center;\n");
      out.write("\n");
      out.write("Content goes here</div>\n");
      out.write("<div id=\"menu\" style=\"background-color:#FFb842; height:600px;width:250px;float:right;\">\n");
      out.write("<section >\n");
      out.write("<form action=\"\" autocomplete=\"on\">\n");
      out.write("<fieldset>\n");
      out.write("<legend>Login information</legend>\n");
      out.write("<br>\n");
      out.write("\n");
      out.write("<b> E-mail :</b> &nbsp &nbsp <input type=\"email\" name=\"email\" autofocus>\n");
      out.write("<br>\n");
      out.write("<br>\n");
      out.write("<b>Password:</b> <input type=\"password\" name=\"pwd\" autocomplete=\"off\">\n");
      out.write("<br>\n");
      out.write("<br>\n");
      out.write("<button style=\"background-color:#ffff66\" onclick=\"validateUser()\" >Login</button>\n");
      out.write("<br>\n");
      out.write("<input type=\"checkbox\" name=\"remember\" value=\"remember\">Remember me &nbsp &nbsp  \n");
      out.write("<a href=\"http://www.w3schools.com/\" target=\"_blank\">Forgot password?</a> \n");
      out.write("<br> <br>\n");
      out.write("</fieldset>\n");
      out.write("<img src=\"pinned.png\">\n");
      out.write("</form>\n");
      out.write("\n");
      out.write("</div>\n");
      out.write("\n");
      out.write("\n");
      out.write("<div id=\"footer\" style=\"background-color:#FFA500;clear:both;text-align:center;\">\n");
      out.write("t</div>\n");
      out.write("\n");
      out.write("</div>\n");
      out.write(" \n");
      out.write("\n");
      out.write("</body>\n");
      out.write("</html>\n");
    } catch (Throwable t) {
      if (!(t instanceof SkipPageException)){
        out = _jspx_out;
        if (out != null && out.getBufferSize() != 0)
          out.clearBuffer();
        if (_jspx_page_context != null) _jspx_page_context.handlePageException(t);
        else throw new ServletException(t);
      }
    } finally {
      _jspxFactory.releasePageContext(_jspx_page_context);
    }
  }
}
