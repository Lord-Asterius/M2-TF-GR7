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


public class FeatureAllSearch
{
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    @Given("^The teacher is on the student list page$")
    public void theTeacherIsOnTheStudentListPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();
        Utils.connectToSite(m_driver);
        Utils.loginTeacher(m_driver);

        m_driver.findElement(By.linkText("Etudiants")).click();
    }

    @Given("^The administative staff is on the student list page$")
    public void theAdminStaffIsOnTheStudentListPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();
        Utils.connectToSite(m_driver);
        Utils.loginAdministrativeStaff(m_driver);

        m_driver.findElement(By.linkText("Etudiants")).click();
    }

    @Given("^The administrator is on the student list page$")
    public void theAdminIsOnTheStudentListPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();
        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);

        m_driver.findElement(By.linkText("Etudiants")).click();
    }

    @Given("^The administative staff is on the teacher list page$")
    public void theAdminStaffIsOnTheTeacherListPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();
        Utils.connectToSite(m_driver);
        Utils.loginAdministrativeStaff(m_driver);

        m_driver.findElement(By.linkText("Enseignants")).click();
    }

    @Given("^The administrator is on the teacher list page$")
    public void theAdminIsOnTheTeacherListPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();
        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);

        m_driver.findElement(By.linkText("Enseignants")).click();
    }

    @Given("^The administrator is on the module list page$")
    public void theAdminIsOnTheModuleListPage()
    {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();
        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);

        m_driver.findElement(By.linkText("Modules")).click();
    }

    @When("^The user enter a student name in the student search bar$")
    public void theUserEnterAStudentNameInTheSearchBar()
    {
        m_driver.findElement(By.id("listSearch")).click();
        m_driver.findElement(By.id("listSearch")).sendKeys("Djamal");
    }

    @When("^The user enter a teacher name in the teacher search bar$")
    public void theUserEnterATeacherNameInTheSearchBar()
    {
        m_driver.findElement(By.id("listSearch")).click();
        m_driver.findElement(By.id("listSearch")).sendKeys("Gerard");
    }

    @When("^The user enter a module name in the module search bar$")
    public void theUserEnterAModuleNameInTheSearchBar()
    {
        m_driver.findElement(By.id("listSearch")).click();
        m_driver.findElement(By.id("listSearch")).sendKeys("test");
    }


    @Then("^The student appear in the student search result$")
    public void theStudentAppearInTheSearchResult()
    {
        List<WebElement> elements = m_driver.findElements(By.linkText("Djamal Dormi"));
        assert(elements.size() > 0);
    }

    @Then("^The teacher appear in the teacher search result$")
    public void theTeacherAppearInTheSearchResult()
    {
        List<WebElement> elements = m_driver.findElements(By.linkText("Gerard Mendufric"));
        assert(elements.size() > 0);
    }
    @Then("^The module appear in the module search result$")
    public void theModuleAppearInTheSearchResult()
    {
        List<WebElement> elements = m_driver.findElements(By.linkText("test pas vraiment fonctionnelle"));
        assert(elements.size() > 0);
    }
}
