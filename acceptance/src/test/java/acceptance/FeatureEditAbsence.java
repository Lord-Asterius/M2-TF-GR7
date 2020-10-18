package acceptance;

import cucumber.api.java.en.Given;
import cucumber.api.java.en.Then;
import cucumber.api.java.en.When;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.NoSuchElementException;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

import java.util.HashMap;
import java.util.Map;

import static org.hamcrest.CoreMatchers.is;
import static org.junit.Assert.assertThat;

public class FeatureEditAbsence {
    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;


    @Given("^L’utilisateur est  un enseignant$")
    public void lutilisateurestenseignat() {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
        Utils.loginTeacher(m_driver);

    }

    @When("^L’enseignant modifie l’absence d'un etudiant$")
    public void enseignatmodifabs() {
        m_driver.findElement(By.linkText("test pas vraiment fonctionnelle")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(1) img")).click();
        try {
            m_driver.findElement(By.cssSelector("tr:nth-child(1) .navbar-brand:nth-child(1) > img")).click();//NOTE: selenium ide trouve cet element dans le dom mais pas Junit
        } catch (NoSuchElementException e){
            assert(false);
        }
        m_driver.findElement(By.id("datepicker")).sendKeys("2020/10/17");
        m_driver.findElement(By.id("absenceTime")).sendKeys("01:35");
        m_driver.findElement(By.id("absenceTime")).sendKeys("12:35");
        m_driver.findElement(By.id("absenceTime")).sendKeys("12:03");
        m_driver.findElement(By.id("absenceTime")).sendKeys("12:34");
        m_driver.findElement(By.name("comment")).sendKeys("comment");
        m_driver.findElement(By.name("reason")).sendKeys("reason");
        m_driver.findElement(By.cssSelector(".btn-primary")).click();
    }

    @Then("^L’absence a été modifie$")
    public void absmodif() {
        assertThat(m_driver.findElement(By.cssSelector("tr:nth-child(1) > td:nth-child(1)")).getText(), is("Guy"));
        assertThat(m_driver.findElement(By.cssSelector("tr:nth-child(1) > td:nth-child(2)")).getText(), is("Hotine"));
        assertThat(m_driver.findElement(By.cssSelector("tr:nth-child(1) > td:nth-child(3)")).getText(), is("test pas vraiment fonctionnelle"));
        assertThat(m_driver.findElement(By.cssSelector("tr:nth-child(1) > td:nth-child(4)")).getText(), is("reason"));
        assertThat(m_driver.findElement(By.cssSelector("tr:nth-child(1) > td:nth-child(6)")).getText(), is("2020-10-17 12:34:00"));
    }

}
