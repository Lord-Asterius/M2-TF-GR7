package acceptance;

import cucumber.api.java.en.Given;
import cucumber.api.java.en.Then;
import cucumber.api.java.en.When;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class FeatureLoginRedirection
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    @Given("^User is on the login page$")
    public void userIsOnTheLoginPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
    }

    @When("^The user connect as an administrator$")
    public void theUserConnectAsAnAdministrator()
    {
        Utils.loginAdmin(m_driver);
    }

    @When("^The user connect as an administrative staff$")
    public void theUserConnectAsAnAdministrativeStaff()
    {
        Utils.loginAdministrativeStaff(m_driver);
    }

    @When("^The user connect as a teacher$")
    public void theUserConnectAsATeacher()
    {
        Utils.loginTeacher(m_driver);
    }

    @Then("^The user is redirected to the administration page$")
    public void theUserIsRedirectedToTheAdministrationPage()
    {
        String classes = m_driver.findElement(By.linkText("Administration")).getAttribute("class");
        assert(classes.contains("active"));
    }

    @Then("^The user is redirected to the alert page$")
    public void theUserIsRedirectedToTheAlertPage()
    {
        String classes = m_driver.findElement(By.linkText("Alertes")).getAttribute("class");
        assert(classes.contains("active"));
    }

    @Then("^The user is redirected to the module list page$")
    public void theUserIsRedirectedToTheModuleListPage()
    {
        String classes = m_driver.findElement(By.linkText("Modules")).getAttribute("class");
        assert(classes.contains("active"));
    }
}
