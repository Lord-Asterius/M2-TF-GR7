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


public class FeatureSearchAlertByNumber
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    @Given("^The administative staff is on the alert page$")
    public void theAdminStaffIsOnTheAlertPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();
        Utils.connectToSite(m_driver);
        Utils.loginAdministrativeStaff(m_driver);
    }

    @When("^The user enter a student number in the search bar$")
    public void theAdminStaffEnterAStudentNameInTheSearchBar()
    {
        m_driver.findElement(By.id("tableSearch")).click();
        m_driver.findElement(By.id("tableSearch")).sendKeys("987");
    }

    @Then("^The student appear in the search result$")
    public void theStudentAppearInTheSearchResult()
    {
        List<WebElement> elements = m_driver.findElements(By.linkText("Djamal Dormi"));
        assert(elements.size() > 0);
    }
}