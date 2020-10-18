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

import static org.hamcrest.CoreMatchers.is;
import static org.junit.Assert.*;

public class FeatureEditModule
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;
    String m_oldModuleName;

    @Given("^The administrator is connected on a module modification page$")
    public void theAdministratorIsConnectedOnAModuleModificationPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);

        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .navbar-brand:nth-child(1) > img")).click();
    }

    @When("^The administrator change the module name with \"([^\"]*)\"$")
    public void theAdministratorChangeTheModuleNameWith(String name) 
    {
        m_oldModuleName = name;
        m_driver.findElement(By.id("moduleName")).click();
        m_driver.findElement(By.id("moduleName")).sendKeys(name);
    }

    @Then("^The new module name must be \"([^\"]*)\"$")
    public void theNewModuleNameMustBe(String name) 
    {
        m_driver.findElement(By.cssSelector(".btn")).click();
        assertThat(m_driver.findElement(By.linkText(name)).getText(), is(name));
    }

    @Then("^The module shouldn't has changed because empty module names aren't allowed$")
    public void theModuleShouldnTHasChangedBecauseEmptyModuleNamesArenTAllowed()
    {
        {
            List<WebElement> elements = m_driver.findElements(By.linkText(m_oldModuleName));
            assertEquals(0, elements.size());
        }
    }
}
