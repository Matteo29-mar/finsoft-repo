package com.bibloteca.clienti.service;
import ch.qos.logback.core.net.server.Client;
import com.bibloteca.clienti.entity.Clienti;
import java.util.List;
public interface Clientiservice {
    //GET(READ)
    Clienti GetId(Long id);
    List<Clienti>GetAllClienti();
    List<Clienti>GetEmail(String email);
    //POST(CREATE)
    Clienti AddClienti(Clienti NewClienti);
    //PUT(UPDATE)
    Clienti UpdateClienti(Clienti UpdatedClienti);
    //DELETE(DELETE)
    boolean DeleteClientiId(Long id);
    void   Update_Clienti(Clienti OldClienti);
}
