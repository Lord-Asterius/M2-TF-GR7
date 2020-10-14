package acceptance;

import cucumber.api.PendingException;
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

public class FeatureEditModule
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    private String m_oldModuleName;

    @Given("^The administrator is connected on a module modification page$")
    public void theAdministratorIsConnectedOnAModuleModificationPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);

        // TODO : Access to module modification page and store the selected module name
    }

    @When("^The administrator change the module name with \"([^\"]*)\"$")
    public void theAdministratorChangeTheModuleNameWith(String name) throws Throwable
    {
        // Write code here that turns the phrase above into concrete actions
        throw new PendingException();
    }

    @Then("^The new module name must be \"([^\"]*)\"$")
    public void theNewModuleNameMustBe(String name) throws Throwable
    {
        {
            List<WebElement> elements = m_driver.findElements(By.linkText(name));
            assert(elements.size() > 0);
        }
    }

    @Then("^The module shouldn't has changed because empty module names aren't allowed$")
    public void theModuleShouldnTHasChangedBecauseEmptyModuleNamesArenTAllowed()
    {
        {
            List<WebElement> elements = m_driver.findElements(By.linkText(m_oldModuleName));
            assert(elements.size() > 0);
        }
    }
}
