package acceptance;

import cucumber.api.java.en.Given;
import cucumber.api.java.en.Then;
import cucumber.api.java.en.When;
import org.openqa.selenium.By;
import org.openqa.selenium.Dimension;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

import java.util.HashMap;
import java.util.List;
import java.util.Map;


public class FeatureMail
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    @Given("^An administrative staff is connected on the alert page$")
    public void theAdminStaffIsOnTheIndexPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
        Utils.loginAdministrativeStaff(m_driver);
    }
    @Then("^The link to the mailto is shown$")
    public void theMailtoLinkIsShown()
    {
        List<WebElement> elements = m_driver.findElements(By.cssSelector("input:nth-child(1)"));
        assert(elements.size() > 0);
    }

}
