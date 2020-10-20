package acceptance;

import cucumber.api.java.en.And;
import cucumber.api.java.en.Given;
import cucumber.api.java.en.Then;
import cucumber.api.java.en.When;
import org.openqa.selenium.By;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

import static org.hamcrest.CoreMatchers.is;
import static org.junit.Assert.assertThat;


public class FeatureSubscribeEnseignant {

    private HtmlUnitDriver m_driver;

    @Given("^l'administrateur est connectee$")
    public void anAdministrativeStaff() {
        m_driver = new HtmlUnitDriver();
        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);
        m_driver.findElement(By.linkText("Administration")).click();

    }


    @When("^L'administrateur ajoute un module à l'enseignant$")
    public void UtilisateurAjouteModuleEnseignant() {
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("test pas vraiment fonctionnelle")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).click();
        m_driver.findElement(By.cssSelector(".btn")).click();
    }

    @And("^admin ajoute un autre module$")
    public void AjoutUnAutreModule(){
        m_driver.findElement(By.linkText("Administration")).click();
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("etude de trucs")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).click();
        m_driver.findElement(By.cssSelector(".btn")).click();
    }

    @Then("^les modules ont ete ajouté$")
    public void ModulesSontAjouteee() {
        m_driver.findElement(By.linkText("Administration")).click();
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("test pas vraiment fonctionnelle")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants")).click();
        assertThat(m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).getText(), is("Jean Tanrien"));

        m_driver.findElement(By.linkText("Administration")).click();
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("etude de trucs")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants")).click();
        assertThat(m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).getText(), is("Jean Tanrien"));
    }


}
