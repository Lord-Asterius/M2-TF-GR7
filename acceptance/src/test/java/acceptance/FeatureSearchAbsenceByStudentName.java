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

public class FeatureSearchAbsenceByStudentName
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    @Given("^A teacher is connected and go to the absence page$")
    public void theUserIsOnTheAbsenceListPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();
        Utils.connectToSite(m_driver);
        Utils.loginTeacher(m_driver);

        m_driver.findElement(By.linkText("Absences")).click();
    }

    @When("^The user enter a student name in the absence search bar$")
    public void theUserEnterAStudentNameInTheSearchBar()
    {
        m_driver.findElement(By.id("listSearch")).click();
        m_driver.findElement(By.id("listSearch")).sendKeys("Djamal");
    }

    @Then("^The name of the student appear in the absence search result$")
    public void theStudentAppearInTheSearchResult()
    {
        List<WebElement> elements = m_driver.findElements(By.linkText("Djamal Dormi"));
        assert(elements.size() > 0);
    }
}