package acceptance;

import cucumber.api.java.en.Given;
import cucumber.api.java.en.Then;
import cucumber.api.java.en.When;
import cucumber.api.java.en.And;
import org.openqa.selenium.By;
import org.openqa.selenium.Dimension;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

import java.util.HashMap;
import java.util.Map;

import static org.hamcrest.CoreMatchers.is;
import static org.junit.Assert.assertThat;
import static org.junit.Assert.assertTrue;


public class FeatureSubscribeEnseignantRef {

    private HtmlUnitDriver m_driver;

    @Given("^l'administrateur est connecte$")
    public void anAdministrativeStaff() {
        m_driver = new HtmlUnitDriver();
        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);
        m_driver.findElement(By.linkText("Administration")).click();

    }


    @When("^L'admin ajoute un module à l'enseignant référent$")
    public void lUtilisateurAjouteModuleEnseifnantRef() {
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("test pas vraiment fonctionnelle")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants référents")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).click();
        m_driver.findElement(By.cssSelector(".btn")).click();
    }

    @And("^on lui ajoute un autre module$")
    public void AjoutAutreModule(){
        m_driver.findElement(By.linkText("Administration")).click();
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("etude de trucs")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants référents")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).click();
        m_driver.findElement(By.cssSelector(".btn")).click();
    }

    @Then("^les modules ont été ajouté$")
    public void ModulesSontAjoutes() {
        m_driver.findElement(By.linkText("Administration")).click();
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("test pas vraiment fonctionnelle")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants référents")).click();
        assertThat(m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).getText(), is("Jean Tanrien"));

        m_driver.findElement(By.linkText("Administration")).click();
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("etude de trucs")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants référents")).click();
        assertThat(m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).getText(), is("Jean Tanrien"));
    }


    @Given("^l'administrateur est connecté et l'enseignant référent est inscrit à un module$")
    public void aTeacherAlreadySubscribeAtOneModule(){
        m_driver = new HtmlUnitDriver();
        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);
        m_driver.findElement(By.linkText("Administration")).click();

        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("test pas vraiment fonctionnelle")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants référents")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).click();
        m_driver.findElement(By.cssSelector(".btn")).click();
    }


    @When("^L'admin l'inscrit dans un autre module$")
    public void AdminAjouteAutreModule() {
        m_driver.findElement(By.linkText("Administration")).click();
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("etude de trucs")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants référents")).click();
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).click();
        m_driver.findElement(By.cssSelector(".btn")).click();
    }

    @Then("^il est maintenant inscrit à 2 modules$")
    public void AdminInscritDeuxModules() {
        m_driver.findElement(By.linkText("Administration")).click();
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("test pas vraiment fonctionnelle")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants référents")).click();
        assertThat(m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).getText(), is("Gerard Mendufric"));

        m_driver.findElement(By.linkText("Administration")).click();
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        m_driver.findElement(By.linkText("etude de trucs")).click();
        m_driver.findElement(By.linkText("Gerer l\'inscription des Enseignants référents")).click();
        assertThat(m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).getText(), is("Gerard Mendufric"));

    }

}
