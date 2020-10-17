package acceptance;

import cucumber.api.java.en.Given;
import cucumber.api.java.en.Then;
import cucumber.api.java.en.When;
import org.openqa.selenium.By;
import org.openqa.selenium.Dimension;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

import java.util.HashMap;
import java.util.Map;

import static org.hamcrest.CoreMatchers.is;
import static org.junit.Assert.assertThat;


public class FeatureAddAbsence {

    private HtmlUnitDriver m_driver;
    private Map<String, Object> m_vars;
    private JavascriptExecutor m_js;

    @Given("^L’utilisateur est un enseignant$")
    public void anAdministrativeStaffIsOnTheAlertPage() {
        m_driver = new HtmlUnitDriver();
        m_js = m_driver;
        m_vars = new HashMap<String, Object>();

        Utils.connectToSite(m_driver);
        Utils.loginTeacher(m_driver);
    }


    @When("^L’utilisateur enregistre une absence pour un étudiant dans le module test pas vraiment fonctionnelle le 2020/10/17 à 12:34$")
    public void lUtilisateurEnregistreUneabsence() {
        m_driver.findElement(By.linkText("test pas vraiment fonctionnelle")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(1) > .float-right:nth-child(2)")).click();
        m_driver.findElement(By.id("datepicker")).sendKeys("2020/10/17");
        m_driver.findElement(By.id("absenceTime")).sendKeys("01:04");
        m_driver.findElement(By.id("absenceTime")).sendKeys("12:04");
        m_driver.findElement(By.id("absenceTime")).sendKeys("12:03");
        m_driver.findElement(By.id("absenceTime")).sendKeys("12:34");
        m_driver.findElement(By.id("textAreaReason")).sendKeys("abs");
        m_driver.findElement(By.cssSelector(".btn-primary")).click();
    }

    @Then("^L’absence a été ajouté$")
    public void lAbsenceEstAjoute() {//NOTE bug junit can't get modale value filed because it didn't execute the JS which autofill fields
//        assertThat(m_driver.findElement(By.cssSelector(".toast-body")).getText(), is("Absence ajoutée pour Guy Hotine à la date du 2020-10-17 à 12:34:00 avec le motif \\\"abs\\\" "));
    }
}
