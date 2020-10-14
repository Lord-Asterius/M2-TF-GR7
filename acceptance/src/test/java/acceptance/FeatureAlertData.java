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

public class FeatureAlertData
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;


    @Given("^An administrative staff is on the alert page$")
    public void anAdministrativeStaffIsOnTheAlertPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
        Utils.loginAdministrativeStaff(m_driver);
    }

    @Then("^The name, the student number and the number of absences are shown$")
    public void theNameTheStudentNumberAndTheNumberOfAbsencesAreShown()
    {
        {
            List<WebElement> elements = m_driver.findElements(By.xpath("//th[contains(.,\'Numéro étudiant\')]"));
            assert(elements.size() > 0);
        }
        {
            List<WebElement> elements = m_driver.findElements(By.xpath("//th[contains(.,\'Nom\')]"));
            assert(elements.size() > 0);
        }
        {
            List<WebElement> elements = m_driver.findElements(By.xpath("//th[3]"));
            assert(elements.size() > 0);
        }
    }
}
