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


public class FeatureSearch
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    @Given("^The user is on the module list page$")
    public void theUserIsOnTheModuleListPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();
        m_driver.get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test7/preprod/index.php");
        Utils.loginAdmin(m_driver);

        m_driver.findElement(By.linkText("Modules")).click();
    }

    @When("^The user enter a module name in the search bar$")
    public void theUserEnterAModuleNameInTheSearchBar()
    {
        m_driver.findElement(By.id("listSearch")).click();
        m_driver.findElement(By.id("listSearch")).sendKeys("Test");
    }

    @Then("^The module appear in the search result$")
    public void theModuleAppearInTheSearchResult()
    {
        List<WebElement> elements = m_driver.findElements(By.linkText("test pas vraiment fonctionnelle"));
        assert(elements.size() > 0);
    }
}
