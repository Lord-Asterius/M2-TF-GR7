package acceptance;

import cucumber.api.java.en.And;
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

public class FeatureEditUser
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    private String m_firstName;
    private String m_lastName;

    @Given("^The administrator is connected$")
    public void theAdministratorIsConnected()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);
    }

    @And("^The administrator is on a student modification page$")
    public void theAdministratorIsOnAStudentModificationPage()
    {
        m_driver.findElement(By.linkText("Etudiants")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(1) > a")).click();
        m_firstName = m_driver.findElement(By.name("first_name")).getAttribute("value");
        m_lastName = m_driver.findElement(By.name("last_name")).getAttribute("value");
    }

    @And("^The administrator is on a teacher modification page$")
    public void theAdministratorIsOnATeacherModificationPage()
    {
        m_driver.findElement(By.linkText("Enseignants")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(1) > a")).click();
        m_firstName = m_driver.findElement(By.name("first_name")).getAttribute("value");
        m_lastName = m_driver.findElement(By.name("last_name")).getAttribute("value");
    }

    @When("^The administrator change the name with \"([^\"]*)\"$")
    public void theAdministratorChangeTheNameWith(String name)
    {
        m_driver.findElement(By.name("first_name")).click();
        m_driver.findElement(By.name("first_name")).clear();
        m_driver.findElement(By.name("first_name")).sendKeys(name);
        m_driver.findElement(By.cssSelector(".btn-primary")).click();
    }

    @Then("^The new first name must be \"([^\"]*)\"$")
    public void theNewFirstNameMustBe(String name)
    {
        {
            List<WebElement> elements = m_driver.findElements(By.linkText(name + " " + m_lastName));
            assert(elements.size() > 0);
        }
    }

    @Then("^The first name shouldn't has changed because empty first name aren't allowed$")
    public void theFirstNameShouldnTHasChangedBecauseEmptyFirstNameArenTAllowed()
    {
        {
            List<WebElement> elements = m_driver.findElements(By.linkText(m_firstName + " " + m_lastName));
            assert(elements.size() > 0);
        }
    }
}
