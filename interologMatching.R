#!/usr/bin/env Rscript

rm(list=ls(all=TRUE))

library(data.table, quietly = TRUE)
library("RMySQL", quietly = TRUE)

mydb <- dbConnect(MySQL(), user='rkataria', password='charlie0909', dbname='trustdb', host='127.0.01')
# mydb <- dbConnect(MySQL(), user='raghav', password='Charlie#0909', dbname='trustdb', host='127.0.01')

args <- commandArgs(trailingOnly=TRUE)

speciesA <- args[1]
speciesB <- args[2]

databases <- args[3]
evalueSpeciesA  <- args[4]
identitySpeciesA <- args[5]
coverageSpeciesA <- args[6]

evalueSpeciesB <- args[7]
identitySpeciesB <- args[8]
coverageSpeciesB <- args[9]

list.databases <- strsplit(databases, "_")[[1]]
##i<-1
for(i in 1:length(list.databases)){
  
  speciesA.output <- fread(paste("/var/www/html/trustdb/Interolog/",speciesA, "_vs_", list.databases[i], ".txt", sep = ""))
  speciesB.output <- fread(paste("/var/www/html/trustdb/Interolog/",speciesB, "_vs_", list.databases[i], ".txt", sep = ""))
  
  colnames.speciesA.output <- c("hostProtein", "interactor_A", "pident", "length", "mismatch", "gapopen", "qstart",
                                  "qend", "sstart", "send", "evalue", "bitscore", "qcovs")
  colnames.speciesB.output <- c("pathogenProtein", "interactor_B", "pident", "length", "mismatch", "gapopen", "qstart",
                            "qend", "sstart", "send", "evalue", "bitscore", "qcovs")
  
  colnames(speciesA.output) <- colnames.speciesA.output
  colnames(speciesB.output) <- colnames.speciesB.output

  speciesA.output.filtered <- speciesA.output[speciesA.output$evalue <= evalueSpeciesA & speciesA.output$pident >= identitySpeciesA & speciesA.output$qcovs >= coverageSpeciesA,]
  speciesB.output.filtered <- speciesB.output[speciesB.output$evalue <= evalueSpeciesB & speciesB.output$pident >= identitySpeciesB & speciesB.output$qcovs >= coverageSpeciesB,]

  
  interactorA <- toString(shQuote(unique(speciesA.output.filtered$interactor_A)))
  interactorB <- toString(shQuote(unique(speciesB.output.filtered$interactor_B)))
  
  
  ### A1 vs B1
  query <- paste('SELECT * FROM ', list.databases[i], ' WHERE (interactor_A IN(', interactorA,') AND interactor_B IN(',
                  interactorB, ') ) OR (interactor_A IN(', interactorB, ') AND interactor_B IN(',
                  interactorA, ') )', sep = '')
  query.result <- dbSendQuery(mydb, query)
  result.dataframe <- fetch(query.result, n=-1)
  result.dataframe <- result.dataframe[, c(1,2)]
  dbClearResult(query.result)
  
  speciesA.output.filtered <- speciesA.output.filtered[,c(1,2)]
  speciesB.output.filtered <- speciesB.output.filtered[,c(1,2)]
  
  tmp <- merge(result.dataframe, speciesA.output.filtered)
  interolog1 <- merge(tmp, speciesB.output.filtered)
  tmp <- NULL
  
  colnames(result.dataframe) <- c("interactor_B","interactor_A")
  tmp <- merge(result.dataframe, speciesA.output.filtered)
  interolog2 <- merge(tmp, speciesB.output.filtered)
  tmp <- NULL
  
  interolog <- rbind(interolog1, interolog2)
  interolog1 <- NULL
  interolog2 <- NULL
  gc()
  
  interolog <- unique(interolog[, c(1,2,3,4)])
  interolog$database <- list.databases[i]
  interolog$speciesA <- speciesA
  interolog$speciesB <- speciesB
  
  output.filename <- paste("/var/www/html/trustdb/tmp/",speciesA,"vs",speciesB,"_",list.databases[i],"_ea",evalueSpeciesA,"_ia",identitySpeciesA,"_ca",coverageSpeciesA,"_eb",evalueSpeciesB,"_ib",identitySpeciesB,"_cb",coverageSpeciesB,".txt", sep = "")
  write.table(interolog, output.filename, sep = "\t", quote = FALSE, col.names = FALSE, row.names = FALSE)
}
