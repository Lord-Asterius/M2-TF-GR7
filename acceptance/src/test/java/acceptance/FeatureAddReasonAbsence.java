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


public class FeatureAddReasonAbsence {

    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    @Given("^The user is connected and is on the absence page$")
    public void anUserIsOnTheAbsencePage() {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
        Utils.loginTeacher(m_driver);
    }


    @Then("^The button for add reason is accessible$")
    public void theButtonIsHere() {
        List<WebElement> elements =m_driver.findElements(By.cssSelector("tr:nth-child(1) .float-right > img"));
        assert(elements.size() > 0);
    }
}
